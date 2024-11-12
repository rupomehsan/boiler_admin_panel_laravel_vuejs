<template>

    <div id="authentication">
        <div class="container">
            <div class="background">
                <div class="shape"></div>
                <div class="shape"></div>
            </div>
            <div>
                <slot></slot>
            </div>
        </div>
    </div>
</template>

<script>
export default {

}
</script>
<style>
#authentication {
    background-color: #080710;
    min-height: 100vh;
}

#authentication .background {
    display: none;
    width: 430px;
    position: absolute;
    transform: translate(-50%, -50%);
    left: 50%;
    top: 50%;
}

#authentication .background .shape {
    height: 200px;
    width: 200px;
    position: absolute;
    border-radius: 50%;
}

#authentication .shape:first-child {
    background: linear-gradient(#1845ad, #23a2f6);
    left: -80px;
    top: -80px;
}

#authentication .shape:last-child {
    background: linear-gradient(to right, #ff512f, #f09819);
    right: -30px;
    bottom: -80px;
}

#authentication form {
    background-color: rgba(255, 255, 255, 0.13);
    border-radius: 10px;
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255, 255, 255, 0.1);
    box-shadow: 0 0 40px rgba(8, 7, 16, 0.6);
    padding: 20px 35px;
    margin: 0 auto;
}

#authentication form * {
    color: #ffffff;
    letter-spacing: 0.5px;
    outline: none;
}

#authentication form span {
    font-size: 12px;
    text-decoration: none;
}

#authentication form a {
    font-size: 12px;
    text-decoration: none;
}

#authentication form h3 {
    font-size: 32px;
    font-weight: 500;
    line-height: 42px;
    text-align: center;
    border-bottom: 1px solid gray;
    padding-bottom: 20px;
}

#authentication label {
    display: block;
    margin-top: 30px;
    font-size: 16px;
    font-weight: 500;
}

#authentication input {
    display: block;
    height: 50px;
    width: 100%;
    background-color: rgba(255, 255, 255, 0.07);
    border-radius: 3px;
    padding: 0 10px;
    margin-top: 8px;
    font-size: 14px;
    font-weight: 300;
}

#authentication ::placeholder {
    color: #e5e5e5;
}

#authentication .btn-outline-success {
    width: 100%;
    color: #080710;
    padding: 15px 0;
    font-size: 18px;
    font-weight: 600;
    border-radius: 5px;
    cursor: pointer;
    border: 1px solid #424242;
}

#authentication .social {
    margin-top: 30px;
    display: flex;
}

#authentication .social div {
    background: red;
    width: 150px;
    border-radius: 3px;
    padding: 5px 10px 10px 5px;
    background-color: rgba(255, 255, 255, 0.27);
    color: #eaf0fb;
    text-align: center;
}

#authentication .social div:hover {
    background-color: rgba(255, 255, 255, 0.47);
}

#authentication .social .fb {
    margin-left: 25px;
}

#authentication .social i {
    margin-right: 4px;
}

#authentication .alert-warning {
    color: red;
    padding: 5px 10px;
}

#authentication #toasterMessage {
    position: absolute;
    top: 20px;
    right: 0px;
    display: none;
}

#authentication #toasterMessage p {
    color: rgb(255, 255, 255);
    background-color: #f09819;
    padding: 5px 10px;
    font-size: 20px;
}

@media only screen and (max-width: 500px) {
    #authentication .background {
        width: 300px;
        height: 520px;
        position: absolute;
        transform: translate(-50%, -50%);
        left: 30%;
        top: 50%;
    }

    #authentication form {
        width: 300px;
    }

    #authentication .shape:first-child {
        left: 60px;
    }
}

#authentication #userList {
    overflow-y: auto;
    background-color: rgba(255, 255, 255, 0.13);
    backdrop-filter: blur(10px);
}

#authentication .spinner-border {
    width: 1.5rem;
    height: 1.5rem;
}

#authentication .password-icon {
    position: relative;
}

#authentication .password-icon i {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
}
</style>
