<template>
<div class="content-wrapper" style="min-height: 971.94px;">

 <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Videos</h1>
        </div>
      </div>
    </div>
    <!-- /.container-fluid -->
  </section>
   <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <div class="row">
              <div class="col-sm-12 col-md-5">
                <h3 class="card-title">List</h3>
              </div>
              <div class="col-sm-12 col-md-7">
                <router-link :to="{ name: 'video.create' }" class="btn btn-success float-right">
                  Add New
                  <i class="fas fa-cart-plus"></i>
                </router-link>
              </div>
            </div>
          </div>

          <!-- /.card-header -->
          <div class="card-body">
            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
              <div class="row">
                <div class="col-sm-12">
                  <datatable :columns="columns" :length="getAllVideos.length">
                    <tr role="row" class="odd" v-for="video in getAllVideos" :key="video.id">
                      <td class="sorting_1">{{ video.id }}</td>
                      <td>
                        <img
                          src="/img/default-150x150.png"
                          v-if="video.image_url == null"
                          alt="Product"
                          class="img-circle img-size-64 mr-2"
                        />
                        <img
                          :src="video.image_url"
                          v-else
                          alt="Product"
                          class="img-circle img-size-64 mr-2"
                        />
                      </td>
                      <td>{{ video.keyword }}</td>
					  <td class="project-state text-center">
                        <span class="badge badge-primary">{{ video.type }}</span>
                      </td>
                      <td>{{ video.created_by }}</td>
                      <td class="project-state text-center">
                        <span v-show="video.is_send_notification" class="badge badge-success">Send</span>
                        <span v-show="!video.is_send_notification" class="badge badge-warning">Not send</span>
                      </td>
                      <td class="project-actions text-right">
                        <div class="row">
                          <!-- /.col -->
                          <div class="col-sm-3 border-right">
                            <!-- <router-link
                              :to="{ name: 'product.edit',  params: { id: product.id } }"
                              class="btn btn-info btn-xs"
                            >
                              <i class="fas fa-pencil-alt"></i>
                            </router-link> -->
                          </div>
                          <!-- /.col -->
                          <div class="col-sm-3">
                            <a
                              class="btn btn-danger btn-xs"
                              @click="deleteVideo(video.id)"
                              href="#"
                            >
                              <i class="fas fa-trash"></i>
                            </a>
                          </div>
                          <!-- /.col -->
                        </div>

                        <!-- <a class="btn btn-info btn-sm" @click="editProduct(product.id)" href>
                          <i class="fas fa-pencil-alt"></i>
                          Edit
                        </a>-->
                      </td>
                    </tr>
                  </datatable>
                </div>
              </div>
              <pagination :meta_data="getMetaData" v-on:next="fetchListVideos"></pagination>
            </div>
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
import pagination from "@Admin/components/Pagination.vue";
import datatable from "@Admin/components/DataTable.vue";

export default {
  name: "VideoList",
  components: {
    pagination,
    datatable
  },
  data() {
    return {
      columns: [
        { width: "2%", label: "#", name: "id", active: true },
        { width: "10%", label: "", name: "thumbnail", active: true },
        { width: "23%", label: "Keyword", name: "keyword", active: true },
        { width: "15%", label: "Type", name: "type", active: true },
        { width: "20%", label: "Created By", name: "created_by", active: true },
        { width: "15%", label: "Notification", name: "is_send_notification", active: true },
        { width: "18%", label: "Action", name: "action", active: false }
      ]
    };
  },
  methods: {
    ...mapActions([
      "fetchListVideos"
    ]),
  },
  created() {
    this.fetchListVideos();
  },
  computed: mapGetters(["getAllVideos", "getMetaData"])
};
</script>
