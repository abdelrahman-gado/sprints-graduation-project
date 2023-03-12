import { Component } from '@angular/core';
import { CartLine } from 'src/app/interface/cart-line';
import { StorageService } from 'src/app/service/storage/storage.service';

@Component({
  selector: 'app-cart',
  templateUrl: './cart.component.html',
  styleUrls: ['./cart.component.css']
})
export class CartComponent {


  cartLines:CartLine[] = [];

  constructor(private storageService:StorageService){
    this.cartLines = storageService.getCartLines();
  }

  getSubTotal():number{
    return this.cartLines
    .map((x)=>x.price * x.quantity)
    .reduce((a,v) => (a += v), 0);}

  getShipping():number{
    return this.cartLines
    .map((x)=>x.quantity)
    .reduce((a,v) => (a += v), 0) * 10;}


  getTotal():number{

      return this.getShipping() + this.getSubTotal(); }
}


