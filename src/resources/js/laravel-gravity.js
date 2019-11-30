import Vue from 'vue';
import TextEditor from './text-editor.vue';
import ColorPicker from './color-picker.vue';

new Vue({
    el: '#app',
    components: {
        TextEditor,
        ColorPicker
    }
})