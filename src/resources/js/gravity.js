import Vue from 'vue';
import VTooltip from 'v-tooltip';
import TextEditor from './text-editor/text-editor.vue';
import ColorPicker from './color-picker.vue';
import VerticalMenu from './vertical-menu.vue';
import ManagePagesList from './manage-pages-list.vue';

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

Vue.use(VTooltip);

new Vue({
    el: '#app',
    components: {
        TextEditor,
        ColorPicker,
        VerticalMenu,
        ManagePagesList
    }
})