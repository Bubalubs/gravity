<template>
    <div class="modal" :class="{ 'is-active': active }">
        <div class="modal-background" @click="close()"></div>
        <div class="modal-card">
            <section class="modal-card-body">
                <slot></slot>
            </section>
        </div>
        <button class="modal-close is-large" aria-label="close" @click.prevent="close()"></button>
    </div>
</template>

<script>
    export default {
        props: [
            'isActive'
        ],

        data() {
            return {
                active: true
            }
        },

        mounted() {
            this.active = this.isActive;
        },

        methods: {
            close() {
                this.active = false;
                
                this.$emit('close');
            }
        },

        watch: { 
            isActive: function(newVal) {
                this.active = newVal;
            }
        }
    }
</script>