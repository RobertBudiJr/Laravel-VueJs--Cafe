## Menu

### Get Menu

Method : GET
Endpoint : `api/kasir/menu`, `api/admin/menu`, `api/kasir/menu`
Field : None

### Show Menu

Method : GET
Endpoint : `api/kasir/menu/{id}`, `api/admin/menu/{id}`, `api/manajer/menu/{id}`
Field : None

### Create Menu

Method : POST
Endpoint : `api/admin/menu`
Field : Body

```Form Data
nomor_menu:Ayam Bakar
jenis:Makanan
deskripsi:Ayam dibakar
gambar:localhost/
harga:12000
```

### Update Menu

Method : PUT
Endpoint : `api/admin/menu/{id}`
Field : Body

```x-www-form-urlencoded
nomor_menu:Ayam Bakar
jenis:Makanan
deskripsi:Ayam terbakar
gambar:localhost/
harga:12000
```

### Delete Menu

Method : DELETE
Endpoint : `api/admin/menu/{id}`
Field : None
