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
                <div class="form-group">
                    <label>Type</label>
                    <select
                    name="parent_id"
                    id="parent_id"
                    class="custom-select"
                    >
                    <option value>Select one</option>
                    </select>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 offset-md-4">
                    <img
                        class="img-thumbnail mx-auto"
                        width="200"
                        height="200"
                        alt="image"
                    />
                    </div>
                </div>

                <div class="custom-file mb-3">
                    <input
                    type="file"
                    class="custom-file-input"
                    id="validatedCustomFile"
                    />
                    <label class="custom-file-label" for="inputGroupFile02"></label>
                </div>

                <div class="form-group">
                    <label for="inputDescription">Keyword</label>
                    <textarea
                    id="inputDescription"
                    class="form-control"
                    rows="4"
                    ></textarea>
                </div>

                <div class="custom-file mb-3">
                    <input
                    type="file"
                    class="custom-file-input"
                    id="validatedCustomFile"
                    />
                    <label class="custom-file-label" for="inputGroupFile02">Upload Video</label>
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
    ]),
    createVideo(){

    }
  },
  computed: mapGetters([])
};
</script>
