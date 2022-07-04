<div>

  

<form action="/forgotpassword" method="POST">

  @if(session()->has('status'))
  
        <h2>{{ session()->get('status') }}</h2>
    
@endif

@error('email')
    <h2>{{$message}}</h2>
@enderror

  @csrf
  <input type="email" name="email" id="" placeholder="Registered Email">
  <button>Send Reset Link</button>
</form>

</div>

<style>
  div{
    height: 100vh;
    width: 100vw;
    display: flex;
    justify-content: center;
    align-items:center; 
  }

  form{
    display: flex;
    justify-content: center;
    align-items:center; 
    flex-direction: column;
  }
  input{
    width: 100%;
  outline: none;
  box-shadow: 0 0 5px rgba(82, 82, 82);
  color: rgba(75, 75, 75);
  background-color: aliceblue;
  font-size: 1.1rem;
  border: 2px solid lightblue;
  border-radius: 10px;
  padding: 12px 18px;
  margin: 10px;
  width: 150%;
  font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;

  }
  input:focus{
    transition: 0.2s;
  border-color: rgb(0, 98, 255);
  }

  button{
    outline: none;
  width: 100%;
  padding: 14px 0;
  font-size: 1.02rem;
  font-family: Verdana, Geneva, Tahoma, sans-serif;
  background-color: rgb(184, 215, 226);
  box-shadow: 0px 2px 5px rgba(75, 75, 75);
  border-radius: 15px;
  cursor: pointer;
  border: none;

  }

  h2{
    color:rgb(40,40,40);
    font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    margin: 0;
  }
</style>