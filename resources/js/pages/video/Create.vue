<template>
<div class="content-wrapper" style="min-height: 971.94px;">

 <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Add New Video</h1>
        </div>
      </div>
    </div>
    <!-- /.container-fluid -->
  </section>
   <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-8 offset-2">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Quick Form</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form
                    @submit.prevent="createVideo"
                    enctype="multipart/form-data"
                >

                    <div class="row mb-3">
                        <div class="col-md-4 offset-md-4">
                        <img
                            class="img-thumbnail mx-auto"
                            width="200"
                            height="200"
                            :src="getThumb.url"
                            alt="user image"
                        />
                        </div>
                    </div>

                    <div class="custom-file mb-3">
                        <input
                        type="file"
                        @change="addThumb"
                        class="custom-file-input"
                        aria-describedby="imageHelpInline"
                        :class="{ 'is-invalid': hasError('image_url') }"
                        id="image_url" />
                        <label class="custom-file-label" for="image_url">{{ getThumb.name }}</label>
                        <small id="imageHelpInline" class="text-muted">
                            Image should be less size 2MB
                        </small>
                        <has-error field="image_url"></has-error>
                    </div>
                    
                    <div class="custom-file mb-3">
                        <input 
                        type="file" 
                        id="video_uri" 
                        aria-describedby="videoHelpInline"
                        @change="onInputChange" 
                        class="custom-file-input"
                        :class="{ 'is-invalid': hasError('video_uri') }" />
                        <label class="custom-file-label" v-if="getFiles.length == 0" for="video_uri">Upload Video</label>
                        <label class="custom-file-label" v-else for="video_uri" v-text="getFiles[0].name"></label>
                        <small id="videoHelpInline" class="text-muted">
                            Video should be with ext mp4 or avi with max size 20MB
                        </small>
                        <has-error field="video_uri"></has-error>
                    </div>

                    <div class="form-group row">
                        <label for="type" class="col-sm-4 col-form-label">Type:</label>
                        <div class="col-sm-8">
                            <select
                                id="type"
                                v-model="getSingleVideo.type"
                                :class="{ 'is-invalid': hasError('type') }"
                                class="custom-select">
                                <option value disabled>Select one</option>
                                <option value="free">Free</option>
                                <option value="payed">Payed</option>
                            </select>
                            <has-error field="type"></has-error>
                        </div>
                    </div>
                
                    <div class="form-group row">
                        <label for="keyword" class="col-sm-4 col-form-label">Keyword:</label>
                        <div class="col-sm-8">
                            <input
                                type="text"
                                v-model="getSingleVideo.keyword"
                                :class="{ 'is-invalid': hasError('keyword') }"
                                class="form-control"
                                placeholder="Enter keyword"
                                aria-describedby="keywordHelpInline"
                                id="keyword"/>
                                <small id="keywordHelpInline" class="text-muted">
                                    Sperate between keyword with , char.
                                </small>
                            <has-error field="keyword"></has-error>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                    <router-link :to="{ name: 'videos.index' }" class="btn btn-danger">
                      Cancel
                    </router-link>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
</template>

<script>
import { mapState, mapGetters, mapActions } from "vuex";
import HasError from "@Admin/components/HasError.vue";

export default {
  name: "CreateVideo",
    components: {
        HasError
    },
  data() {
    return {
    };
  },
  methods: {
    ...mapActions([
        "storeVideo",
        "addThumb",
        "resetVideo",
        "addFile"
    ]),
    createVideo(){
        const formData = new FormData();
        for (const [key, value] of Object.entries(this.getSingleVideo)) {
            formData.append(key, value);
        }
        if (this.getFiles.length > 0) {
            this.getFiles.forEach(file => {
                formData.append("video_uri", file, file.name);
            });
        }
        if (this.getThumb.file) {
            formData.append("image_url", this.getThumb.file);
        }
        this.storeVideo(formData);
    },
    onInputChange(e) {
      const files = e.target.files;
      this.addFile(files[0]);
    },
  },
  created() {
    this.resetVideo();
  },
  computed: mapGetters(["getSingleVideo", "getThumb", "getFiles", "hasError"])
};
</script>
