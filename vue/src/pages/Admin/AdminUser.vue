<template>
  <div>
    <div class="row">
      <div class="col-12">
        <card class="card" :header-classes="{ 'text-right': isRTL }">
          <h4 slot="header" class="card-title">
            {{ $t("Manage Users") }}
          </h4>
          <div class="table-responsive">
            <user-list></user-list>
          </div>
        </card>
      </div>
    </div>
  </div>
</template>
<script>
import UserTable from "../Dashboard/UserTable";
import UserList from "../UserList";

export default {
  components: {
    UserTable,
  },
};
</script>
