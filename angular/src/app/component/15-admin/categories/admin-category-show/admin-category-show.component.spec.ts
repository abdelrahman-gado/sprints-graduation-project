import { ComponentFixture, TestBed } from '@angular/core/testing';

import { AdminCategoryShowComponent } from './admin-category-show.component';

describe('AdminCategoryShowComponent', () => {
  let component: AdminCategoryShowComponent;
  let fixture: ComponentFixture<AdminCategoryShowComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ AdminCategoryShowComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(AdminCategoryShowComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
