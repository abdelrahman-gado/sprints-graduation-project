import { Component, Input, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { Product } from 'src/app/interface/product';
import { ProductService } from 'src/app/service/product/product.service';
import { StorageService } from 'src/app/service/storage/storage.service';

@Component({
  selector: 'app-product-detail',
  templateUrl: './product-detail.component.html',
  styleUrls: ['./product-detail.component.css']
})
export class ProductDetailComponent implements OnInit{

  id:number = 0;
  product:Product = {} as Product;
  //you may also like
  products:Product[] = [];

  constructor(private route:ActivatedRoute, 
  private productService:ProductService, 
  private storageService:StorageService,
  
  ){

  }

  ngOnInit() :void{
        
    this.route.params.subscribe((params) => {
      this.id = +params['id'];
    });

    this.productService.getProductsById(this.id).subscribe((data:any)=>{
      this.product = data;

      this.productService.getProductByCategoryId(this.product.category.id).subscribe((data:any)=> {
        console.log(data)
      this.products = data;
      });
    });

  }

  addProductToCart(){
    this.storageService.addProducts(this.product, 1);
  }

  incQuantity(i:number){
  }

  decQuantity(i:number){
  }

}