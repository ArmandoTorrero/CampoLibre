
export function validatePasswd(passwd) {
    
    const passwdRegex = /^.{5,}$/;

    return passwdRegex.test(passwd);
}