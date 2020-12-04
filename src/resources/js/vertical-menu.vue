<template>
    <ul class="menu-list">
        <vertical-menu-item
            v-for="item in menu"
            :key="item.label"
            :item="item"
            :current-path="currentPath"
        >
        </vertical-menu-item>
    </ul>
</template>

<script>
    import VerticalMenuItem from './vertical-menu-item.vue';

    export default {
        components: {
            VerticalMenuItem
        },

        props: [
            'menuData',
            'currentPath'
        ],

        data() {
            return {
                menu: [],
                showMenu: []
            }
        },

        mounted() {
            if (this.menuData) {    
                this.menu = this.menuData;
            }
        },

        methods: {
            toggleMenu(key) {
                if (key in this.showMenu) {
                    this.$set(this.showMenu, key, !this.showMenu[key]);
                } else {
                    this.$set(this.showMenu, key, true);
                }
            }
        }
    }
</script>