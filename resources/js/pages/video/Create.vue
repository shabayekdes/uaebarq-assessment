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
                        :class="{ 'is-invalid': hasError('image_url') }"
                        id="image_url" />
                        <label class="custom-file-label" for="image_url">{{ truncate(getThumb.name,20) }}</label>
                        <has-error field="image_url"></has-error>
                    </div>
                    
                    <div class="custom-file mb-3">
                        <input 
                        type="file" 
                        id="video_uri" 
                        @change="onInputChange" 
                        class="custom-file-input"
                        :class="{ 'is-invalid': hasError('video_uri') }" />
                        <label class="custom-file-label" for="video_uri">Upload Video</label>
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
                                <option selected disabled>Select one</option>
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
                                id="keyword"/>
                            <has-error field="keyword"></has-error>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="submit" class="btn btn-primary" data-dismiss="modal">Cancel</button>
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
import { mapGetters, mapActions } from "vuex";
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
        "addFile"
    ]),
    createVideo(){
        const formData = new FormData();
        for (const [key, value] of Object.entries(this.getSingleVideo)) {
            formData.append(key, value);
        }
        this.getFiles.forEach(file => {
            formData.append("video_uri", file, file.name);
        });
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
  computed: mapGetters(["getSingleVideo", "getThumb", "getFiles", "hasError"])
};
</script>
