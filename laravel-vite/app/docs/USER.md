## User

### Login

Method : POST
Endpoint : `api/login`
Field : Params

```Params
email:jonadmin@gmail.com
password:123456
```

### Logout

Method : POST
Endpoint : `api/logout`
Field : None

### Get User

Method : GET
Endpoint : `api/admin/user`
Field : None

### Show User

Method : GET
Endpoint : `api/admin/user/{id}`
Field : None

### Create User

Method : POST
Endpoint : `api/admin/user`
Field : Body

```Form Data
nama_user:Jon
role:1
username:JonAdmin123
email:jonadmin@gmail.com
password:123456
```

### Update User

Method : PUT
Endpoint : `api/admin/user/{id}`
Field : Body

```x-www-form-urlencoded
nama_user:Jon
role:2
username:JonAdmin123
email:jonadmin@gmail.com
password:123456
```

### Delete User

Method : DELETE
Endpoint : `api/admin/menu/{id}`
Field : None
