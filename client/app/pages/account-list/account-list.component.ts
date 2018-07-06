// Import Libraries
import { Observable } from 'rxjs/Rx';
import { Component, OnInit } from '@angular/core';
import { MatDialog, MatDialogRef, MAT_DIALOG_DATA } from "@angular/material";
import { ModalRemoveComponent } from '../../components/modal-remove.component';


// Import Services
import { AccountService } from '../../services/account.service';

// Import Models
import { Account } from '../../domain/ssu_db/account';

import { CashFlow } from '../../domain/ssu_db/cash-flow';

import { User } from '../../domain/ssu_db/user';

// START - USED SERVICES
/*
 *	AccountService.delete
 *		PARAMS: 
 *		
 *
 *	AccountService.list
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

@Component({
    selector: "account-list",
    templateUrl: './account-list.component.html',
    styleUrls: ['./account-list.component.css']
})
export class AccountListComponent implements OnInit {
    
    // Attributes
    list: Account[];
    search: any = {};
    idSelected: string;
    
    // Constructor
    constructor(
        private accountService: AccountService, 
        public dialog: MatDialog) {}

    // Functions
    ngOnInit(): void {
        this.accountService.list().subscribe(list => this.list = list);
    }

    openModal(id: string): void {
        let dialogRef = this.dialog.open(ModalRemoveComponent, {
            width: '250px',
            data: () => {
                // Execute on confirm
                this.accountService.remove(id).subscribe(() => {
                    dialogRef.close();
                });
                this.list = this.list.filter(item => item._id != id);
            }
        });
    }

}