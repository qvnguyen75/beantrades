<template>
    <div class="container">
        <section>
            <div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Pair</th>
                            <th>Type</th>
                            <th>Side</th>
                            <th>Value</th>
                            <th>Created at</th>
                            <th>status</th>                                
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="trade in trades">
                            <td>{{ trade.id }}</td>
                            <td>{{ trade.tradingPair }}</td>
                            <td>{{ trade.type }}</td>
                            <td>{{ trade.side }}</td>
                            <td>{{ trade.value }}</td>
                            <td>{{ trade.dateBuy }}</td>
                            <td>{{ trade.cancelled }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</template>

<script setup>
    defineProps({
        trades: {
            type: Array
        }
    })  
</script>