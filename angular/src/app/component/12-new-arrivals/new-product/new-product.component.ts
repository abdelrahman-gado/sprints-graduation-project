import { Component,Input } from '@angular/core';
import { Product } from 'src/app/interface/product';
import { StorageService } from 'src/app/service/storage/storage.service';

@Component({
  selector: 'app-new-product',
  templateUrl: './new-product.component.html',
  styleUrls: ['./new-product.component.css']
})
export class NewProductComponent {
  @Input() product: Product = {} as Product

  constructor(private storageService:StorageService){}

  addProductToCart(){
    this.storageService.addProducts(this.product, 1);
  }
}
