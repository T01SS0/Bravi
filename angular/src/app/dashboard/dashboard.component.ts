import { Component, OnInit } from '@angular/core';
import { ApiService } from 'app/api/api.service';
import { Contato } from 'app/interfaces/contato';

@Component({
  selector: 'app-dashboard',
  templateUrl: './dashboard.component.html',
  styleUrls: ['./dashboard.component.css']
})
export class DashboardComponent implements OnInit {

  contatos:Array<Contato>;

  constructor(private api:ApiService) { 
    this.contatos = [];
  }
  ngOnInit() {
    this.buscarContatos();
    console.log(this.contatos);
  }
  buscarContatos()
  {
    this.api.obterContatos().subscribe(contatos => this.contatos = contatos);
  }
  excluirContato(id:number)
  {
    this.api.deletarContato(id).subscribe(ret=>{
      this.buscarContatos();
      alert('Contato excluido com sucesso!');      
    });
  }

}
