import React, {useState, useEffect} from 'react';

function SignIn() {

    const [loginUrl, setLoginUrl] = useState(null);

    useEffect(() => {
        fetch('http://localhost:8000/api/auth/github', {
            headers : {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        })
            .then((response) => {
                if (response.ok) {
                    return response.json();
                }
                throw new Error('Ocorreu um erro!');
            })
            .then((data) => setLoginUrl( data.url ))
            .catch((error) => console.error(error));
    }, []);

    return (
        <div>
            {loginUrl != null && (
                <a href={loginUrl}>Login</a>
            )}
        </div>
    );
}

export default SignIn;