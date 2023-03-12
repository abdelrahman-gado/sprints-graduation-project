import { Component,Input,OnInit } from '@angular/core';
import { Product } from 'src/app/interface/product';
import { ProductService } from 'src/app/service/product/product.service';

@Component({
  selector: 'app-new-arrivals',
  templateUrl: './new-arrivals.component.html',
  styleUrls: ['./new-arrivals.component.css']
})
export class NewArrivalsComponent implements OnInit {

  products: Product[] = []

constructor(private productService:ProductService){}

ngOnInit(): void {
    this.productService.getNewArrivals().subscribe((data:any)=>this.products = data)
  
  }
}
