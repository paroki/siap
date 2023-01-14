class User {
    constructor() {
        const data = localStorage.getItem('user');
        this.token = ""
        if(data){
            const json = JSON.parse(data)
            this.token = json.token
        }
    }
    store(data){
        localStorage.setItem('user', JSON.stringify(data))
    }
}

const user = new User()

export default user