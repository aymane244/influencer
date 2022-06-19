<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500&display=swap');
    *{
        margin:0;
        padding: 0;
    }
    body{
        font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
    }
    .div-center{
        width: 50%;
        height: 50%;
        margin-left: auto;
        margin-right:auto;
        margin-top:6%;
        margin-bottom:6%;
    }
    .div-style{
        background-color: white;
        padding: 3rem 5rem 3rem 5rem;
        border-radius: 6px;
        box-shadow: 5px 5px 15px black;
    }
    .div-position{
        display:flex;
        justify-content: space-around;
        margin-bottom: 30px;
    }
    .center-header{
        text-align: center;
        font-size: 30px;
    }
    .div-error{
        margin-top:20px;
        margin-bottom:20px;
        background-color:#df4759;
        margin-left:100px;
        margin-right:100px;
        padding-top:10px;
        padding-bottom:10px;
    }
    .div-success{
        margin-top:20px;
        margin-bottom:20px;
        background-color:#42ba96;
        margin-left:100px;
        margin-right:100px;
        padding-top:10px;
        padding-bottom:10px;
    }
    input{
        width: 50%;
        padding: 8px;
        border: 1px solid lightseagreen;
        outline: lightseagreen;
    }
    .input-conn{
        width: 100%;
        border: none;
        border-bottom: black solid 1px;
        font-size: 1.1rem;
        padding: 5px;
    }
    .input-conn:focus{
        background-color: rgba(156, 156, 156, 0.12);
        border-bottom: black solid 1px;
    }
    .label-inscrirption{
        background-color: rgb;
        padding: 2px;
    }
    .center-form{
        padding: 0;
        width: 100%;
    }
    .div-links{
        text-align: center;
        margin-top: 20px;
        padding-bottom: 10px;
        font-size: 18px;
        color: #8AF3FF;
    }
    .link-space{
        margin-right: 20px;
        text-decoration: none;
        color: black;
    }
    .link-space:hover{
        text-decoration: underline;
    }
    .btn-submit{
        background-color: black;
        color: white;
        padding: 7px 25px 7px 25px;
        font-size: 16px;
        border-radius: 5px;
        cursor: pointer;
        transition: 0.4s;
    }
    .btn-submit:hover{
        background-color: white;
        color: black;
    }
    .link-deco{
        text-decoration: none;
        border: 1px solid black;
    }
    .div-btn{
        margin-top: 20px;
        text-align: center;
    }
    .titre{
        cursor: pointer;
    }
    .titre:hover{
        text-decoration: underline;
    }
    .input_inscr{
        width: 100%;
        margin-top: 15px;
    }
    .space_inputs_inscr{
        margin-top: 20px;
        width: 100%;
    }
    .navbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px;
        box-shadow: 0 1px 5px 1px rgba(0, 0, 0, 0.2);
        width: 100%;
        position: fixed;
        background-color: white;
        transition: all 0.5s ease-in-out;
        z-index:4;
    }
    .div-grid{
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .items{
        margin: 0 10px;
        color: black;
        padding: 5px 15px;
        border-radius: 100px;
        transition: all 0.5s ease-in-out;
        text-decoration: none;
    }
    .active, .items:hover {
        background-color: black;
        color: white;
    }
    .container{
        padding-left: 80px;
        padding-right: 80px;
    }
    .div-position-mesenger{
        display: flex;
        justify-content: center;
    }
    .bg-contact{
        background-color: black;
        color: white;
        width: 30%;
    }
    .img-contact{
        border-radius: 50%;
        width: 12%;
    }
    .contacts{
        cursor: pointer;
        color: white;
        text-decoration: none;
    }
    .contacts:hover{
        text-decoration: none;
    }
    .img-chat{
        border-radius: 50%;
        width: 5%;
    }
    .div-margin{
        margin-top: 0px;
    }
    .publisher {
        position: relative;
        display: -webkit-box;
        display: flex;
        -webkit-box-align: center;
        align-items: center;
        padding: 12px 20px;
        background-color: #f9fafb
    }
    .publisher>*:first-child {
        margin-left: 0
    }
    .publisher>* {
        margin: 0 8px
    }
    .publisher-input {
        -webkit-box-flex: 1;
        flex-grow: 1;
        border: none;
        outline: none !important;
        background-color: transparent
    }
    .publisher-btn {
        background-color: transparent;
        border: none;
        color: black;
        font-size: 16px;
        cursor: pointer;
        overflow: -moz-hidden-unscrollable;
        -webkit-transition: .2s linear;
        transition: .2s linear;
    }
    .bt-1 {
        border-top: 1px solid #ebebeb !important
    }
    .border-light {
        border-color: #f1f2f3 !important
    }
    .message{
        padding-top: 20px;
        padding-left:20px;
    }
    .other_message{
        background: #e8f1f3;
        padding: 18px 20px;
        border-radius: 7px;
        display: inline-block;
        position: relative;
        border-bottom-color: #e8f1f3;
        left: 72%;
        width: 21%;
    }
    .my_message{
        background: #e8f1f3;
        padding: 18px 20px;
        border-radius: 7px;
        display: inline-block;
        position: relative;
        border-bottom-color: #e8f1f3;
        width: 21%;
    }
    .img-chat-receiver{
        border-radius: 50%;
        width: 17%;
    }
    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        padding-top: 100px; /* Location of the box */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    }
    /* Modal Content */
    .modal-content {
        background-color: #fefefe;
        margin: auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        padding-bottom:20px;
    }
    /* The Close Button */
    .close {
        color: #aaaaaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }
    .close:hover,
    .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }
    .wrapper {
        position: relative;
        width: 50%;
        border-radius: 10px;
        display: flex;
        justify-content: center;
        flex-direction: column;
        align-items: center;
        margin: 20px;
        margin-left: auto;
        margin-right: auto;
        padding-top:20px;
        padding-bottom:20px;
    }
    .wrapper,
    .wrapper .img-area,
    .social-icons a {
        background: #ecf0f3;
        box-shadow: -3px -3px 7px #ffffff, 3px 3px 5px #ceced1;
    }
    .wrapper .img-area {
        height: 150px;
        width: 150px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .img-area .inner-area {
        height: calc(100% - 25px);
        width: calc(100% - 25px);
        border-radius: 50%;
    }
    .inner-area img {
        height: 100%;
        width: 100%;
        border-radius: 50%;
        object-fit: cover;
    }
    .wrapper .name, .entreprise, .email, .site {
        font-size: 23px;
        font-weight: 500;
        color: #31344b;
        margin: 10px 0 5px 0;
    }
    .wrapper .horizon {
        width: 50%;
        height: 2px;
        border-width: 0;
        background-color: #e4e4e4;
        margin: 10px 0 5px 0;
    }
    .wrapper .contacter {
        background: #ecf0f3;
        box-shadow: -3px -3px 7px #ffffff, 3px 3px 5px #ceced1;
    }
    .wrapper .contacter {
        position: relative;
        width: 250px;
        border: none;
        outline: none;
        padding: 5px;
        color: #31344b;
        font-size: 18px;
        font-weight: 450;
        border-radius: 5px;
        cursor: pointer;
        z-index: 4;
        margin: 10px 0 15px 0;
        text-align: center;
        z-index: 1;
    }
    .link_contact{
        color: #31344b;
        text-decoration: none;
    }
    .wrapper .social-icons {
        text-align: center;
    }
    .social-icons a {
        position: relative;
        height: 35px;
        width: 35px;
        margin: 0 3;
        margin-top: 5;
        margin-bottom: 5;
        display: inline-flex;
        text-decoration: none;
        border-radius: 50%;
    }
    .social-icons a:hover::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        border-radius: 50%;
        background: #ecf0f3;
        box-shadow: inset -3px -3px 7px #ffffff, inset 3px 3px 5px #ceced1;
    }
    .social-icons a i {
        position: relative;
        z-index: 3;
        text-align: center;
        width: 100%;
        height: 100%;
        line-height: 35px;
    }
    .social-icons a.fb i {
        color: #4267b2;
    }
    .social-icons a.insta i {
        color: #dd2a7b;
    }
    .topper {
        width:99%;
        background-color:black; 
        color:white;
        padding-top: 5px;
        padding-bottom: 5px;
        padding-left: 10px;
        margin-bottom: 30px;
    }
    .container_profile {
        border:1px solid #ebebeb - 50;
        display: flex;
    }
    .photo {
        width:30%;
        margin-left:2%;
        text-align:center;
        display:block;
        padding-bottom:30px;
    }
    .div-grid-profile{
        display: flex;
        align-items: center;
        justify-content: center;
    }
    table {
        border-right-color: #ffffff;
        font-size: 18px;
        /* /* border: 1px solid #343a40; */
        border-collapse: collapse; 
        width: 100%;
    }
    th, td {
        /* border: 1px solid #343a40; */
        padding: 16px 24px;
    }
    th {
        background-color: #087f5b;
        color: #fff;
        width: 25%;
    }
    tbody tr:nth-child(odd){
        background-color: #f8f9fa;
    }
    tbody tr:nth-child(even){
        background-color: #e9ecef;
    }
    .input_inscr_profile{
        width: 50%;
        margin-top: 15px;
    }
    .space_inputs_inscr_profile{
        margin-top: 20px;
        width: 80%;
        margin-left: auto;
        margin-right: auto;
    }
    .sidebar{
        width: 345px;
        position: fixed;
        left: 0;
        top: 0;
        height: 100%;
        z-index: 100; 
        background: var(--main-color);
        transition: width 300ms;
    }
    .sidebar-brand{
        height: 90px;
        padding: 1rem 0rem 1rem 2rem;
        color: #fff;
    }
    .sidebar-brand span{
        display: inline-block;
        padding-right: 1rem;
    }
    .sidebar-menu li{
        width: 100%;
        margin-bottom: 1.7rem;
        padding-left: 1rem;
    }
    .sidebar-menu{
        margin-top: 1rem;
    }
    .sidebar-menu a{
        padding-left: 1rem;
        display: block;
        color: #fff;
        font-size: 1.1rem;
    }
    #nav-toggle:checked + .sidebar {
        width: 70px ;
    }
    #nav-toggle:checked + .sidebar .sidebar-brand,
    #nav-toggle:checked + .sidebar li {
        padding-left: 1rem;
        text-align: center;
    }
    #nav-toggle:checked + .sidebar li a {
        padding-left: 0rem;
    }
    #nav-toggle:checked + .sidebar .sidebar-brand h1 span:last-child,
    #nav-toggle:checked + .sidebar li a span:last-child{
        display: none;
    }
    .sidebar-menu a span:first-child{
        font-size: 1.5rem;
        padding-right: 1rem;
    }
    .sidebar-menu a.active{
        background: #fff;
        padding-top: 1rem;
        padding-bottom: 1rem;
        color: var(--main-color);
        border-radius: 30px 0px 0px 30px;
    }
    .sidebar-menu li{
        width: 100%;
        margin-bottom: 1.7rem;
        padding-left: 1rem;
    }
    .sidebar-menu{
        margin-top: 1rem;
    }
    .sidebar-menu a{
        padding-left: 1rem;
        display: block;
        color: #fff;
        font-size: 1.1rem;
    }
    .sidebar-menu a span:first-child{
        font-size: 1.5rem;
        padding-right: 1rem;
    }
    .sidebar-menu a.active{
        background: #fff;
        padding-top: 1rem;
        padding-bottom: 1rem;
        color: var(--main-color);
        border-radius: 30px 0px 0px 30px;
    }
    .profile-pic img {
	    height: 200px;
	    width: 200px;
	    border-radius: 50%;
	    border: 10px solid #ffffff;
    }
    .profile-pic img {
	    height: 200px;
	    width: 200px;
	    border-radius: 50%;
	    border: 10px solid #ffffff;
    }
    .user-wrapper img{
        border-radius: 50%;
        margin-right: .5rem;
    }
</style>