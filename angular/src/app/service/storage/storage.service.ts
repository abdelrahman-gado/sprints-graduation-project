import { Injectable } from '@angular/core';
import { CartLine } from 'src/app/interface/cart-line';
import { Product } from 'src/app/interface/product';

@Injectable({
  providedIn: 'root'
})
export class StorageService {

  constructor() { }
  
  getProductsFromLocalStorage():Product[] {
    return JSON.parse(localStorage.getItem('products') || '[]');
  }

  addProducts(product:Product, quantity:number){

    const products: Product[] = this.getProductsFromLocalStorage();
    for (let index = 0; index < quantity; index++) {
      products.push(product);
  }
  localStorage.setItem('products', JSON.stringify(products));
}

  getCartLines():CartLine[]{
  const products: Product[] = this.getProductsFromLocalStorage();
  const cartLines: CartLine[] = [];
  products.forEach((p) => {
    const ix = cartLines.findIndex((x) => x.product.id === p.id);
    if (ix >= 0) {
      cartLines[ix].quantity += 1;
    } else {
      cartLines.push({
        price: p.price,
        product: p,
        quantity: 1,
      });
    }   
  });
  return cartLines;
  }

  save(cartLines:CartLine[]){
    const products:Product[] = [];
    cartLines.forEach((c) => {
      for(let i=0; i<c.quantity; i++){
        products.push(c.product);
      }
    });
    localStorage.setItem('products', JSON.stringify(products));
  }

  getQuantity():number{
    const products = this.getProductsFromLocalStorage();
    return products?.length || 0;
  }

}
