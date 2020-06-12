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
                    id="validatedCustomFile"
                    />
                    <label class="custom-file-label" for="inputGroupFile02">{{ truncate(getThumb.name,20) }}</label>
                </div>
                
                <div class="custom-file mb-3">
                    <input type="file" id="file" @change="onInputChange" />
                    <label class="custom-file-label" for="file">Upload Video</label>
                </div>

                <div class="form-group row">
                    <label for="type" class="col-sm-4 col-form-label">Type:</label>
                    <div class="col-sm-8">
                        <select
                            id="type"
                            v-model="getSingleVideo.type"
                            class="custom-select">
                            <option disabled>Select one</option>
                            <option value="free">Free</option>
                            <option value="payed">Payed</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="keyword" class="col-sm-4 col-form-label">Keyword:</label>
                    <div class="col-sm-8">
                        <input
                            type="text"
                            v-model="getSingleVideo.keyword"
                            class="form-control"
                            placeholder="Enter keyword"
                            id="keyword"/>
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

export default {
  name: "CreateVideo",
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
  computed: mapGetters(["getSingleVideo", "getThumb", "getFiles"])
};
</script>
