<template>
    <div>
        <h1 class="text-white pt-3 pb-3">Starships game</h1>

        <div class="row" v-if="opponents">
            <div class="col-12">
                <b-alert show variant="dark" class="d-flex">
                    <div class="align-self-center">
                        Round {{round}}:
                        <b>{{ opponents[winner].name }}</b> won the competition
                        {{ getCounter(opponents[winner]._id) }}
                        {{ getCounter(opponents[winner]._id) > 1 ? 'times' : 'time' }}
                    </div>
                    <div class="ml-auto p-2">
                        <b-btn @click="getWinner()" variant="primary">Play again</b-btn>
                        <b-btn variant="primary" v-b-modal.opponents-modal>Pick opponents</b-btn>
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
            <b-modal id="opponents-modal" ref="opponents-modal" title="BootstrapVue" hide-footer>

                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="starshipsA">Player One</label>
                            <b-form-select
                                v-model="selectedA"
                                :options="starshipsA"
                                class="mb-3"
                                id="starshipsA"
                            >
                            </b-form-select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="starshipsB">Player Two</label>
                            <b-form-select
                                v-model="selectedB"
                                :options="starshipsB"
                                class="mb-3"
                                id="starshipsB"
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
            starships: false,
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
            let table = [...this.starshipsArray]
            if (this.selectedB) {
                let item = this.starshipsArray.find(ship => ship.value === this.selectedB)
                if (item) {
                    let index = this.starshipsArray.indexOf(item)
                    table.splice(index, 1)
                }

                return table
            }

            return this.starshipsArray
        },
        starshipsB: function () {
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
                this.getWinner()
            }).catch(error => {
                console.log(error)
            });
        },
        getWinner() {
            let allShips = [...this.starships]
            this.opponents = []

            for (let i = 0; i < 2; i++) {
                let random = Math.floor(Math.random() * allShips.length)
                this.opponents.push(allShips[random])
                allShips.splice(random, 1)
            }

            if (this.opponents[0].troopers > this.opponents[1].troopers) {
                this.winner = 0;
                this.opponents[0].winner = true
                this.opponents[1].winner = false
                this.opponents[0].equal = false
            } else if (this.opponents[0].troopers == this.opponents[1].troopers) {
                this.opponents[0].equal = true
            }
            else {
                this.winner = 1;
                this.opponents[0].winner = false
                this.opponents[1].winner = true
                this.opponents[0].equal = false
            }

            let winnerId = this.opponents[this.winner]._id
            let savedWinner = this.winners.find(ship => ship.id === winnerId)

            if (savedWinner) {
                let index = this.winners.indexOf(savedWinner)
                this.winners[index].wins++
            } else {
                this.winners.push({id: this.opponents[this.winner]._id, wins: 1})
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
        hideModal() {

        }
    }
}
</script>
