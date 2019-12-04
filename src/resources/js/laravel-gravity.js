import Vue from 'vue';
import VTooltip from 'v-tooltip';
import TextEditor from './text-editor.vue';
import ColorPicker from './color-picker.vue';

Vue.use(VTooltip);

new Vue({
    el: '#app',
    components: {
        TextEditor,
        ColorPicker
    }
})