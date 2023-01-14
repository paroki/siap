import routing from "../utils/routing";

class AuthService {
    login(email, password){
        const options = {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                email,
                password
            })
        }
        const url = routing.generate('login', [], true);
        return fetch(new URL(url), options)
            .then(response => {
                if(response.ok){
                    return response.json()
                }else if(401 === response.status){
                    throw new Error('Username atau password anda salah');
                }else{
                    throw new Error('Server sedang mengalami gangguan');
                }
            }).then((data) => {
                localStorage.setItem('user', JSON.stringify(data))
                return data
            })
    }
    logout() {
        localStorage.removeItem('user')
    }
}

const auth = new AuthService()
export default auth;