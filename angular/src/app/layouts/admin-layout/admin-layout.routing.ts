import { Routes } from '@angular/router';

import { DashboardComponent } from '../../dashboard/dashboard.component';
import { ContatoComponent } from 'app/contato/contato.component';

export const AdminLayoutRoutes: Routes = [

    { path: 'dashboard', component: DashboardComponent },
    { path: 'contato', component: ContatoComponent },
    { path: 'contato/:id', component: ContatoComponent },
];
