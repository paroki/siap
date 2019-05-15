import axios from "axios";
import { TokenService } from "@/services";
import SubmissionError from "../utils/SubmissionError";

const ApiService = {
    generateUrl(url) {
        const path = process.env.VUE_APP_API_PATH;
        return `${url}/${path}`;
    },

    init(baseURL) {
        axios.defaults.baseURL = baseURL;

        axios.interceptors.request.use(config => {
            const url = config.url.replace("api/api", "api");
            config.url = url;
            return config;
        });
        axios.interceptors.response.use(
            response => {
                return response.data;
            },
            error => {
                const response = error.response;
                const json = response.data;

                if (json.violations) {
                    const errMsg = json["hydra:description"]
                        ? json["hydra:description"]
                        : response.statusText;
                    const errors = { _error: errMsg };
                    json.violations.map(violation =>
                        Object.assign(errors, {
                            [violation.propertyPath]: violation.message
                        })
                    );

                    throw new SubmissionError(errors);
                }

                return Promise.reject(error);
            }
        );
    },

    setHeader() {
        axios.defaults.headers.common[
            "Authorization"
        ] = `Bearer ${TokenService.getToken()}`;
    },

    removeHeader() {
        axios.defaults.headers.common = {};
    },

    get(resource) {
        return axios.get(resource);
    },

    post(resource, data) {
        return axios.post(resource, data);
    },

    put(resource, data) {
        return axios.put(resource, data);
    },

    delete(resource) {
        return axios.delete(resource);
    },

    /**
     * Perform a custom Axios request.
     *
     * data is an object containing the following properties:
     *  - method
     *  - url
     *  - data ... request payload
     *  - auth (optional)
     *    - username
     *    - password
     **/
    customRequest(data) {
        return axios(data);
    }
};

export default ApiService;
