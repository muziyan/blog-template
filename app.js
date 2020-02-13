const express = require("express");
const app = express();

app.use("/",express.static("./blog-admin"))


app.listen(3000,()=>{
    console.log("listen port 3000")
})