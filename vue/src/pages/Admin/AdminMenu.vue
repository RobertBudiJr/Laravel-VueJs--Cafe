<template>
  <div class="row">
    <div class="col-12">
      <card :title="table1.title">
        <div class="row">
          <card
            v-for="index in table2.data"
            v-bind:key="index.id"
            class="col-3"
            :imageTop="index.gambar"
            :title="index.nama_menu"
            :subTitle="index.jenis"
            :subTitle2="index.harga"
            :btnId="index.id"
          >
            <div class="card-text">{{ index.deskripsi }}</div>
          </card>
        </div>
      </card>
    </div>
  </div>
</template>
<script>
const tableData = [
  {
    id: 1,
    gambar:
      "data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22320%22%20height%3D%22180%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20320%20180%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_1664f6b99d2%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A16pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_1664f6b99d2%22%3E%3Crect%20width%3D%22320%22%20height%3D%22180%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22119.0859375%22%20y%3D%2297.35%22%3E320x180%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E",
    nama_menu: "Ayam Goreng",
    jenis: "Makanan",
    harga: 12000,
    deskripsi: "Ayam digoreng",
  },
  {
    id: 2,
    gambar:
      "data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22320%22%20height%3D%22180%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20320%20180%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_1664f6b99d2%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A16pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_1664f6b99d2%22%3E%3Crect%20width%3D%22320%22%20height%3D%22180%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22119.0859375%22%20y%3D%2297.35%22%3E320x180%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E",
    nama_menu: "Air Putih",
    jenis: "Minuman",
    harga: 5000,
    deskripsi: "Air",
  },
];

export default {
  components: {},
  data() {
    return {
      table1: {
        title: "Manage Menu",
      },
      table2: {
        data: [...tableData],
      },
    };
  },
};
</script>
<style></style>
