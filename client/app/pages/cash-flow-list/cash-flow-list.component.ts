// Import Libraries
import { Observable } from 'rxjs/Rx';
import { Component, OnInit } from '@angular/core';
import { MatDialog, MatDialogRef, MAT_DIALOG_DATA } from "@angular/material";
import { ModalRemoveComponent } from '../../components/modal-remove.component';


// Import Services
import { CashFlowService } from '../../services/cash-flow.service';

// Import Models
import { CashFlow } from '../../domain/ssu_db/cash-flow';
import { Account } from '../../domain/ssu_db/account';import { User } from '../../domain/ssu_db/user';
// START - USED SERVICES
/*
 *	CashFlowService.delete
 *		PARAMS: 
 *					ObjectId id - Id
 *		
 *
 *	CashFlowService.list
 *		PARAMS: 
 *		
 *
 */
// END - USED SERVICES

// START - REQUIRED RESOURCES
/*
 * CashFlowService  
 */
// END - REQUIRED RESOURCES

@Component({
    selector: "cash-flow-list",
    templateUrl: './cash-flow-list.component.html',
    styleUrls: ['./cash-flow-list.component.css']
})
export class CashFlowListComponent implements OnInit {
    
    // Attributes
    list: CashFlow[];
    search: any = {};
    idSelected: string;
    
    // Constructor
    constructor(
        private cashflowService: CashFlowService, 
        public dialog: MatDialog) {}

    // Functions
    ngOnInit(): void {
        this.cashflowService.list().subscribe(list => this.list = list);
    }

    openModal(id: string): void {
        let dialogRef = this.dialog.open(ModalRemoveComponent, {
            width: '250px',
            data: () => {
                // Execute on confirm
                this.cashflowService.remove(id).subscribe(() => {
                    dialogRef.close();
                });
                this.list = this.list.filter(item => item._id != id);
            }
        });
    }

}