<template>
    <div class="media-library-container">
        <a class="button is-primary" @click="toggleShow">Upload Image</a>

        <my-upload
            v-model="show"
            field="file"
            @crop-success="cropSuccess"
            @crop-upload-success="cropUploadSuccess"
            @crop-upload-fail="cropUploadFail"
            url="/admin/api/media/images/upload"
            :width="300"
            :height="300"
            :params="{ _token: csrf }"
            img-format="png"
            langType="en"
        >
        </my-upload>

        <hr>

        <div class="media-library">
            <div class="preview-box" v-for="media in mediaLibrary" :key="media.id">
                <a @click.prevent="selectMedia(media.path)" :title="media.file_name">
                    <img style="max-height:100px;max-width:100px;" :src="media.path" alt="">
                </a>
            </div>
        </div>
    </div>
</template>

<script>
    import imageUpload from 'vue-image-crop-upload/upload-2.vue';
    import axios from 'axios';

    export default {
		components: {
			'my-upload': imageUpload
		},

        data() {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                mediaLibrary: [],
                show: false,
                imgDataUrl: ''
            }
        },

        mounted() {
            this.getMediaLibraryData();
        },

        methods: {
            getMediaLibraryData() {
                axios.get('/admin/api/media/images').then(response => {
                    this.mediaLibrary = response.data;
                });
            },
            
            selectMedia(path) {
                this.$emit('select-media', path);
            },

			toggleShow() {
				this.show = !this.show;
			},

			cropSuccess(imgDataUrl){
				this.imgDataUrl = imgDataUrl;
			},

			cropUploadSuccess(){
                this.getMediaLibraryData();
			},

			cropUploadFail(status, field){
                // TODO: needs better error handling
				console.log('Upload Failed');
				console.log(status);
			}
        }
    }
</script>