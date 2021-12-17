import AbstractView from "./AbstractView.js";
export default class extends AbstractView {
    // constructor() {
    //     super();
    //     this.setTitle("Post");
    // }
    async getHtml() {
        return ' <h1>WELLCOME Post </h1> <a href="/posts" data-link> View Post </a>'
    }
}