import Vue from "vue";
const requireComponent = require.context("@/components", true, /\.vue$/);

requireComponent.keys().forEach(fileName => {
    const componentConfig = requireComponent(fileName);

    /*const componentName = upperFirst(
        camelCase(fileName.replace(/^\.\//, '').replace(/\.\w+$/, ''))
    )*/

    const componentName = componentConfig.default.name;
    if (componentName) {
        Vue.component(
            componentName,
            componentConfig.default || componentConfig
        );
    }
});
