import AbstractView from "./AbstractView.js";
export default class extends AbstractView {
    async getHtml() {
        return ' <h1>WELLCOME </h1> <a href="/posts" data-link> View Post </a>'
    }
}