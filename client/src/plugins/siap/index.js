import LoadingOverlay from "./LoadingOverlay";

const components = [LoadingOverlay];

export default {
    install(Vue) {
        components.forEach(item => {
            Vue.component(item.name, item);
        });
    }
};

export { LoadingOverlay };
