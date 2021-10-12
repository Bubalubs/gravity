<template>
    <div class="media-library-container">
        <div class="media-upload-preview">
            <img :src="uploadedImageURL">
        </div>

        <div class="media-upload-input">
            <form enctype="multipart/form-data">
                <input type="file" name="media" accept="image/png, image/jpeg" @change="selectImage($event)" ref="mediaFile" :disabled="uploading">
            </form>
        </div>

        <div style="margin-top:20px">
            <button type="button" class="button is-primary" @click="uploadImage()" v-if="!uploading">Upload</button>
            <button type="button" class="button is-primary" disabled v-else>Uploading...</button>
        </div>

        <hr>

        <h5 class="title is-5">Media Library</h5>

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
    import axios from 'axios';

    export default {
        data() {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                mediaLibrary: [],
                uploadedImageURL: '',
                uploadedImageData: '',
                uploading: false
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

            selectImage(event) {
                let reader = new FileReader();

                reader.onload = (event) => {
                    if (event.target) {
                        this.uploadedImageURL = event.target.result;
                    }
                };

                reader.readAsDataURL(event.target.files[0]);
                this.uploadedImageData = event.target.files[0];
            },

            uploadImage() {
                if (this.uploadedImageData == '' || this.uploading) {
                    return false;
                }

                this.uploading = true;

                var formData = new FormData();

                formData.append('file', this.uploadedImageData);

                axios.post('/admin/api/media/images/upload', formData)
                    .then(response => {
                        this.uploading = false;

                        this.uploadedImageData = '';
                        this.uploadedImageURL = '';
                        this.$refs.mediaFile.value = null;

                        this.getMediaLibraryData();
                    });
            }
        }
    }
</script>