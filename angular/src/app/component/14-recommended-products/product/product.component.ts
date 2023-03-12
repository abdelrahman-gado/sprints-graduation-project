import { Component, Input } from '@angular/core';
import { Product } from 'src/app/interface/product';
import { StorageService } from 'src/app/service/storage/storage.service';

@Component({
  selector: 'app-product',
  templateUrl: './product.component.html',
  styleUrls: ['./product.component.css']
})
export class ProductComponent {
@Input() product:Product = {} as Product

constructor(private storageService:StorageService){}

  addProductToCart(){
    this.storageService.addProducts(this.product, 1);
  }
}
