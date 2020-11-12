<template>
    <div>
        <h1 class="text-white pt-3 pb-3">Starships game</h1>

        <div class="row" v-if="opponents">
            <div class="col-12">
                <b-alert show variant="dark" class="d-flex">
                    <div class="align-self-center">
                        Round {{round}}:
                        <span v-if="opponents[winner].equal">
                            Starships have the same number of troopers, no one wins.
                        </span>
                        <span v-else>
                            <b>{{ opponents[winner].name }}</b> won the competition
                            {{ getCounter(opponents[winner]._id) }}
                            {{ getCounter(opponents[winner]._id) > 1 ? 'times' : 'time' }}
                        </span>

                    </div>
                    <div class="ml-auto p-2">
                        <b-btn @click="playAgain()" variant="primary">Play again</b-btn>
                        <b-btn variant="primary" @click="showModal">Pick opponents</b-btn>
                    </div>
                </b-alert>
            </div>

            <div class="col-6">
                <b-card
                    header-tag="header"
                    :title="opponents[0].name"
                    :img-src="'img/'+opponents[0].img+'.jpg'"
                    img-alt="Image"
                    tag="article"
                    :bg-variant="opponents[0].winner ? 'success' : 'secondary'"
                    :text-variant="opponents[0].winner ? 'white' : ''"
                >
                    <template #header>
                        <h6 class="mb-0">Total wins: {{ getCounter(opponents[0]._id) }}</h6>
                    </template>

                    <b-card-text>
                        Troopers: {{ opponents[0].troopers }}
                    </b-card-text>
                </b-card>
            </div>

            <div class="col-6">
                <b-card
                    header-tag="header"
                    :title="opponents[1].name"
                    :img-src="'img/'+opponents[1].img+'.jpg'"
                    img-alt="Image"
                    img-top
                    tag="article"
                    :bg-variant="isWinner"
                    :text-variant="opponents[1].winner ? 'white' : ''"
                >
                    <template #header>
                        <h6 class="mb-0">Total wins: {{ getCounter(opponents[1]._id) }}</h6>
                    </template>

                    <b-card-text>
                        Troopers: {{ opponents[1].troopers }}
                    </b-card-text>
                </b-card>
            </div>
        </div>

        <div>
            <b-modal ref="opponents-modal" title="Pick opponents" hide-footer>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>Player One</label>
                            <b-form-select
                                v-model="selectedA"
                                :options="starshipsA"
                                class="mb-3"
                            >
                            </b-form-select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label >Player Two</label>
                            <b-form-select
                                v-model="selectedB"
                                :options="starshipsB"
                                class="mb-3"
                            >
                            </b-form-select>
                        </div>
                    </div>
                </div>

                <b-button class="mt-3" variant="primary" block @click="hideModal">Play the game</b-button>
            </b-modal>
        </div>
    </div>
</template>

<script>
export default {
    name: "starshipsGame",
    data() {
        return {
            selectedA: null,
            selectedB: null,
            starships: [],
            opponents: false,
            winner: false,
            winners: [],
            round: 0
        }
    },
    computed: {
        starshipsArray: function () {
            let ships = []
            this.starships.forEach((ship) => {
                ships.push({value: ship._id, text: ship.name})
            });

            return ships
        },
        starshipsA: function () {
            if (this.selectedB) {
                return this.createStarshipsList(this.selectedB)
            }

            return this.starshipsArray
        },
        starshipsB: function () {
            if (this.selectedA) {
                return this.createStarshipsList(this.selectedA)
            }

            return this.starshipsArray
        },
        isWinner: function () {
            return this.opponents[1].winner ? 'success' : 'secondary'
        }
    },
    created() {
        this.getStarships()
    },
    methods: {
        getStarships() {
            let param = {
                url: '/api/v1/starships',
                method: 'GET',
            };

            axios(param).then(response => {
                this.starships = response.data.data
                this.getOpponents()
                this.getWinner()
            }).catch(error => {
                console.log(error)
            });
        },
        createStarshipsList(selected) {
            let table = [...this.starshipsArray]

            if (selected) {
                let item = this.starshipsArray.find(ship => ship.value === selected)
                if (item) {
                    let index = this.starshipsArray.indexOf(item)
                    table.splice(index, 1)
                }
                return table
            }
        },
        getOpponents(opponents) {
            let allShips = [...this.starships]
            this.opponents = []

            if (opponents) {
                opponents.forEach((opponent) => {
                    const ship = allShips.find(ship => ship._id === opponent)
                    this.opponents.push(ship)
                })
            } else {
                for (let i = 0; i < 2; i++) {
                    let random = Math.floor(Math.random() * allShips.length)
                    this.opponents.push(allShips[random])
                    allShips.splice(random, 1)
                }
            }

            if (this.opponents[0].troopers > this.opponents[1].troopers) {
                this.winner = 0;
                this.opponents[0].winner = true
                this.opponents[1].winner = false
                this.opponents[0].equal = false
            } else if (this.opponents[0].troopers == this.opponents[1].troopers) {
                this.opponents[0].equal = true
                this.opponents[1].equal = true
            }
            else {
                this.winner = 1;
                this.opponents[0].winner = false
                this.opponents[1].winner = true
                this.opponents[0].equal = false
            }
        },
        getWinner() {
            if (!this.opponents[this.winner].equal) {
                let winnerId = this.opponents[this.winner]._id
                let savedWinner = this.winners.find(ship => ship.id === winnerId)

                if (savedWinner) {
                    let index = this.winners.indexOf(savedWinner)
                    this.winners[index].wins++
                } else {
                    this.winners.push({id: this.opponents[this.winner]._id, wins: 1})
                }
            }

            this.round++
        },
        getCounter(id) {
            let winner = this.winners.find(ship => ship.id === id)
            if (winner) {
                let index = this.winners.indexOf(winner)
                return this.winners[index].wins
            }

            return 0;
        },
        playAgain() {
            this.getOpponents()
            this.getWinner()
        },
        showModal() {
            this.selectedA = null
            this.selectedB = null
            this.$refs['opponents-modal'].show()
        },
        hideModal() {
            if (this.selectedA && this.selectedB) {
                this.$refs['opponents-modal'].hide()
                this.getOpponents([this.selectedA, this.selectedB])
                this.getWinner()
            }
        }
    }
}
</script>
