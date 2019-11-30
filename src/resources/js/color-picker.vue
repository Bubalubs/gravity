<template>
    <div class="color-editor">
        <chrome-picker v-model="color"></chrome-picker>

        <input :name="name" type="hidden" v-model="color.hex">
    </div>
</template>

<script>
    import { Chrome } from 'vue-color';

    export default {
        props: [
            'name',
            'placeholder',
            'value'
        ],
        
        components: {
            'chrome-picker': Chrome
        },

        data() {
            return {
                color: ''
            }
        },

        mounted() {
            if (this.value) {    
                this.color = this.value;
            }
        }
    }
</script>