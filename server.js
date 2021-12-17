const express = require("express");
const path = require("path");

const app = express();
app.use("/static", express.static(path.resolve(__dirname, "woocomerce", "static")));

 app.get("/*", (req, res )=> {
     res.sendFile(path.resolve(__dirname,"woocomerece", "archive-product.php"));
 });

// app.listen(process.env.PORT || 5500, ()=> console.log("server is run"));