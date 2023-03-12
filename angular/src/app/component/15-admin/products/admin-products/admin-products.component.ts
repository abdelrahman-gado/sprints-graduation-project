import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { Product } from 'src/app/interface/product';
import { AuthenticationService } from 'src/app/service/Auth/authentication.service';
import { ProductService } from 'src/app/service/product/product.service';

@Component({
  selector: 'app-admin-products',
  templateUrl: './admin-products.component.html',
  styleUrls: ['./admin-products.component.css']
})
export class AdminProductsComponent implements OnInit{
products: Product[] = []
current_page: number = 0
links: any = ''
id: number = 0 


constructor(private productService:ProductService, private route:ActivatedRoute, private auth:AuthenticationService, private router:Router){}

ngOnInit(): void {
    this.productService.getAllProducts().subscribe((data:any)=>this.products = data)
    this.route.params.subscribe(params=>this.id = params['id'])
}

destroy(id:number) {
  this.auth
    .productDestroy(id)
    .subscribe((data: any) => console.log(data));
  this.router.navigate(['/admin-products']);
}

}
