@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                <div class="input-group">
                    <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                    <button type="button" class="btn btn-outline-primary">Search</button>
                </div>  
                  <br>
                <div class="input-group">
                    <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                    <option selected>Sort</option>
                    <option value="1">Price</option>
                    <option value="2">Popular</option>
                    <option value="3">Radius</option>
                  </select>
                  <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                    <option selected>Search by</option>
                    <option value="1">Merchant Name</option>
                    <option value="2">Merchant Type</option>
                    <option value="3">Merchant Distance</option>
                  </select>
                  <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                    <option selected>Filter</option>
                    <option value="1">COD</option>
                    <option value="2">Card</option>
                    <option value="3">E-Wallet</option>
                  </select> 
                </div>
        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <div class="col-md-8" style = "text-align: center;">
            Sugested Menu
        </div>
        <div class="container text-center">
            
        </div>
        
        <table class="table table-dark">
            <tbody>
              <tr class="table-active">
                <div class="card" style="width: 15rem;">
                    <img class="card-img-top" src="..." alt="Card image cap">
                    <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
              </tr>
              <tr>
                <div class="card" style="width: 15rem;">
                    <img class="card-img-top" src="..." alt="Card image cap">
                    <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
              </tr>
              <tr>
                <div class="card" style="width: 15rem;">
                    <img class="card-img-top" src="..." alt="Card image cap">
                    <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
              </tr>
              <tr>
                <div class="card" style="width: 15rem;">
                    <img class="card-img-top" src="..." alt="Card image cap">
                    <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
              </tr>
            </tbody>
          </table>
        
    </div>
    
</div>
@endsection
