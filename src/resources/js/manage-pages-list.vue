<template>
    <div>
        <tree
            ref="tree"
            :options="options"
            @node:dragging:finish="updateOrder"
        >
            <div class="tree-text" slot-scope="{ node }">
                <span class="text">
                    <strong>{{ node.text }}</strong>
                </span>

                <div class="field is-grouped" style="margin-top:8px">
                    <div style="margin-right:4px">
                        <a @click.stop :href="'/admin/pages/' + node.data.name + '/fields'" class="button is-small">Manage Fields</a>
                    </div>

                    <div>
                        <form method="post" :action="'/admin/pages/' + node.data.name + '/delete'">
                            <input type="hidden" name="_token" :value="csrf">
                            <input type="hidden" name="_method" value="delete">

                            <button @click.stop type="submit" class="button is-small is-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </tree>
    </div>
</template>

<script>
    import LiquorTree from 'liquor-tree';
    import axios from 'axios';

    export default {
        components: {
            [LiquorTree.name]: LiquorTree
        },

        data() {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                options: {
                    dnd: true,
                    propertyNames: {
                        id: 'id',
                        text: 'display_name',
                        data: 'data'
                    },
                    fetchData(node) {
                        return axios.get('/admin/api/pages').then(response => response.data);
                    }
                }
            }
        },

        methods: {
            updateOrder() {
                axios.post('/admin/api/pages/update', { 
                    pages: this.$refs.tree.toJSON()
                });
            }
        }
    }
</script>