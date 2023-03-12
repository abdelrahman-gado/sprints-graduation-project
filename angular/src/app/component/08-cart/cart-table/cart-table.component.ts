import { Component, Input } from '@angular/core';
import { CartLine } from 'src/app/interface/cart-line';
import { StorageService } from 'src/app/service/storage/storage.service';


@Component({
  selector: 'app-cart-table',
  templateUrl: './cart-table.component.html',
  styleUrls: ['./cart-table.component.css']
})
export class CartTableComponent {

  constructor(private storageService:StorageService){}

  @Input() cartLines:CartLine[] = [];

  incQuantity(i:number){
    this.cartLines[i].quantity+=1;
    this.storageService.save(this.cartLines);

  }

  decQuantity(i:number){
    if(this.cartLines[i].quantity > 1)
    this.cartLines[i].quantity-=1;
    this.storageService.save(this.cartLines);


  }
  remove(i:number){
    this.cartLines.splice(i,1);
    this.storageService.save(this.cartLines);
  }

}
