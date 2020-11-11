<template>
    <div>
        <h1 class="text-white pt-3 pb-3">Starships game</h1>

        <div class="row" v-if="opponents">

            <div class="col-12">
                <b-alert show variant="success" class="d-flex">
                    <div class="align-self-center">
                        <b>{{opponents[winner].name}}</b> won the competition
                        {{getCounter(opponents[winner]._id)}} {{getCounter(opponents[winner]._id)>1 ? 'times' : 'time'}}
                    </div>
                    <div class="ml-auto p-2">
                        <b-btn @click="getWinner()">Play again</b-btn>
                    </div>
                </b-alert>
            </div>

            <div class="col-6" >
                <b-card
                    header-tag="header"
                    :title="opponents[0].name"
                    img-src="https://picsum.photos/600/300/?random=1"
                    img-alt="Image"
                    tag="article"
                    :bg-variant="opponents[0].winner ? 'success' : 'secondary'"
                    :text-variant="opponents[0].winner ? 'white' : ''"
                >
                    <template #header>
                        <h6 class="mb-0">Total wins: {{getCounter(opponents[0]._id)}}</h6>
                    </template>

                    <b-card-text>
                        Troopers: {{opponents[0].troopers}}
                    </b-card-text>
                </b-card>
            </div>

            <div class="col-6">
                <b-card
                    header-tag="header"
                    :title="opponents[1].name"
                    img-src="https://picsum.photos/600/300/?random=2"
                    img-alt="Image"
                    img-top
                    tag="article"
                    :bg-variant="opponents[1].winner ? 'success' : 'secondary'"
                    :text-variant="opponents[1].winner ? 'white' : ''"
                >
                    <template #header>
                        <h6 class="mb-0">Total wins: {{getCounter(opponents[1]._id)}}</h6>
                    </template>

                    <b-card-text>
                        Troopers: {{opponents[1].troopers}}
                    </b-card-text>
                </b-card>
            </div>
        </div>

    </div>

</template>

<script>
export default {
    name: "starshipsGame",
    data() {
        return {
            starships: false,
            opponents: false,
            winner: false,
            winners: [],
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
            console.log(this.opponents)

            for (let i=0; i<2; i++) {
                let random = Math.floor(Math.random() * allShips.length)
                this.opponents.push(allShips[random]);
                allShips.splice(random, 1)
            }

            if (this.opponents[0].troopers > this.opponents[1].troopers) {
                this.winner = 0;
                this.opponents[0].winner = true
                this.opponents[1].winner = false
            } else {
                this.winner = 1;
                this.opponents[0].winner = false
                this.opponents[1].winner = true
            }

            let savedWinner = this.winners.find(ship => ship.id === id)
            if (savedWinner) {
                let index = this.winners.indexOf(savedWinner);
                this.winners[index].wins++
            } else {
                this.winners.push({id: this.opponents[this.winner]._id, wins: 1 })
            }

        },

        getCounter(id) {
            let winner = this.winners.find(ship => ship.id === id)
            if (winner) {
                let index = this.winners.indexOf(winner);
                return this.winners[index].wins
            }

            return 0;
        }
    }

}
</script>

<style scoped>

</style>
