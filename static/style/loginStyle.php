.authContainer{
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    flex: 1;
    padding: 24px;
}

#nb{
    margin-top: 15px;
    text-align: center;
    font-size: 12px;
}

form{
    display: flex;
    flex-direction: column;
    gap: 14px;
}

form,
.options{
    width: 400px;
    max-width: 100%;
    margin: 0 auto;
}

form label{
    position: relative;
    border: 1px solid navy;
    border-radius: 5px;
}

form input{
    width: 100%;
    border: none;
    background: transparent;
    color: white;
    padding: 14px;
}

form input:focus{
    border: none;
}

form label:focus-within{
    border-color: blue;
}

form button{
    background: navy;
    color: white;
    border: none;
    padding: 14px 0;
    border-radius: 5px;
    cursor: pointer;
    font-size: 1rem;
}

form button:hover{
    background: blue;
}

h1{
    text-align: center;
    font-size: 3rem;
}

.above,
.center{
    position: absolute;
    transform: translateY(-50%);
    pointer-events: none;
    color: white;
    border-radius: 4px;
    padding: 0 6px;
    font-size: 0.8rem;
}

.above{
    top: 0;
    left: 24px;
    background: navy;
    border: 1px solid blue;
    font-size: 0.7rem;
}

.center{
    top: 50%;
    left: 6px;
    border: 1px solid transparent;
    opacity: 0;
}

.error{
    color: coral;
    font-size: 0.9rem;
    font-weight: bold;
    text-align: center;
}

.options{
    padding: 14px 0;
    overflow: hidden;
    font-size: 0.9rem;
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.options > p {
    position: relative;
    text-align: center;
    width: fit-content;
    margin: 0 auto;
    padding: 0 8px;
}

.options > p::after,
.options > p::before{
    position: absolute;
    content: '';
    top: 50%;
    transform: translateY(-50%);
    width: 100vw;
    height: 1.5px;
    background: white;
}

.options > p::after{
    right: 100%;
}

.options > p::before{
    left: 100%;
}

.options div{
    display: flex;
    align-items: center;
    gap: 8px;
    justify-content: center;
}

.options div p:last-of-type{
    color: cyan;
    cursor: pointer;

}