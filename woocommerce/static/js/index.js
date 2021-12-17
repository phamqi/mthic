import Name from "./views/Name.js";
import Price from "./views/Price.js";

const navigateTo = url => {
    history.pushState(null, null, url);
    router();
}
const router  = async ()=> {
    const router = [
        { path: "/", view : Name},
        { path: "/post", view :Price},
        // { path: "/setting", view : ()=> console.log("setting is work")}
    ];
    const potentiaMatches = router.map(route=> {
        return {
            route: route, 
            isMatch: location.pathname === route.path
        }
    });
    let match = potentiaMatches.find(potentiaMatch => potentiaMatch.isMatch)
    if(!match){
        match = {
            route: router[0], 
            isMatch: true
        }
    }
    const view = new match.route.view();
    document.querySelector("#app").innerHTML = await view.getHtml();

};
window.addEventListener("popstate", router);

document.addEventListener("DOMContentLoaded", () => {
    document.body.addEventListener("click", e => {
        if(e.target.matches("[data-link]")) {
            e.preventDefault();
            navigateTo(e.target.href);
        }
    });
    router();
});