// Import Libraries
import { ActivatedRoute, Params } from '@angular/router';
import { Component, OnInit } from '@angular/core';
import { Location } from '@angular/common';

// Import Services
import { AccountService } from '../../services/account.service';

// Import Models
import { Account } from '../../domain/ssu_db/account';

import { CashFlow } from '../../domain/ssu_db/cash-flow';

import { User } from '../../domain/ssu_db/user';

// START - USED SERVICES
/*
 *	AccountService.create
 *		PARAMS: 
 *		
 *
 *	AccountService.get
 *		PARAMS: 
 *		
 *
 *	AccountService.update
 *		PARAMS: 
 *		
 *
 */
// END - USED SERVICES

// START - REQUIRED RESOURCES
/*
 * AccountService  
 */
// END - REQUIRED RESOURCES

/**
 * Edit component for AccountEdit
 */
@Component({
    selector: 'account-edit',
    templateUrl : './account-edit.component.html',
    styleUrls: ['./account-edit.component.css']
})
export class AccountEditComponent implements OnInit {

    item: Account;
    listAccountid: Account[];
    listAccountid: Account[];
	externalCashFlow: CashFlow[];
	externalUser: User[];
    model: Account;
    
    constructor(
        private accountService: AccountService,
        private route: ActivatedRoute,
        private location: Location) {
        // Init item
        this.item = new Account();
	   this.externalCashFlow = [];
	   this.externalUser = [];
    }

    ngOnInit(): void {
            this.route.params.subscribe(param => {
                let id: string = param['id'];
                if (id !== 'new') {
                    // Get item from server 
                    this.accountService.get(id).subscribe(item => this.item = item);
                    
                    
                    this.cashflowService.findByAccountid(id).subscribe(list => this.externalCashFlow = list);
                    
                    this.userService.findByAccountid(id).subscribe(list => this.externalUser = list);
                    
                }
            });
    }

    /**
     * Save Item
     */
    save (formValid:boolean, item: Account): void{
        if (formValid) {
            if(item._id){
                this.accountService.update(item).subscribe(data => this.goBack());
            } else {
                this.accountService.create(item).subscribe(data => this.goBack());
            }  
        }
    }

    /**
     * Go Back
     */
    goBack(): void {
        this.location.back();
    }
    

}