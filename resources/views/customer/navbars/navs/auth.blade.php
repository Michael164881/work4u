<style>

    h1{
        font-weight: bolder;
        margin: 1% 0 0 3%;
        color: #7C638F;
        font-family: Impact, sans-serif;
        letter-spacing: 2px;
    }    

    #nav-expand {
    border-bottom: 0px;
    display: flex;
    justify-content: flex-end; /* Align items to the right */
    align-items: center; /* Center items vertically */
    padding-right: 1rem; /* Optional: Add some right padding */
    }

    .dropdown-item{
        width: 8vw;
        background-color: #D74646;
        padding: 1% 0 1% 0;
        border-radius: 10px;
    }

    .dropdown-item:hover{
        cursor: pointer;
        background-color: #fc3030;
    }

    i{
        margin: 0 15% 0 15% ;
    }

</style>

<h1>CUSTOMER</h1>
<nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent" id="nav-expand">

    <form class="dropdown-item" action="{{ route('logout') }}" id="formLogOut" method="POST" style="display: none;">
        @csrf
    </form>
                       
    <a class="dropdown-item" style="color: white;" onclick="document.getElementById('formLogOut').submit();"><i class="nc-icon nc-button-power"></i>LOG OUT</a>
 
</nav>
