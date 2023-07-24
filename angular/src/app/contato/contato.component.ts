import { Component, OnInit } from '@angular/core';
import { FormBuilder, Validators } from '@angular/forms';
import { ActivatedRoute, Params } from '@angular/router';
import { ApiService } from 'app/api/api.service';
import { Contato } from 'app/interfaces/contato';

import Swal from 'sweetalert2/dist/sweetalert2.js';


@Component({
  selector: 'app-contato',
  templateUrl: './contato.component.html',
  styleUrls: ['./contato.component.css']
})
export class ContatoComponent implements OnInit {

  contato: Contato = {};
  carregando: boolean = false;
  application: string = "Novo Contato";
  id: number;

  constructor(private _formBuilder: FormBuilder, private api: ApiService, private activeRoute: ActivatedRoute) {
    this.contato = {};
  }

  firstFormGroup = this._formBuilder.group({
    nome: [this.contato.nome, Validators.required],
  });
  secondFormGroup = this._formBuilder.group({
    telefone: [this.contato.telefone, Validators.required],
  });
  threeFormGroup = this._formBuilder.group({
    whatsapp: [this.contato.whatsapp, Validators.required],
  });

  ngOnInit(): void {

    this.activeRoute.params.subscribe((params: Params) =>
      this.id = params['id']
    );
    if (this.id != undefined) {
      this.application = "Editar contato";
      this.api.obterContatos(this.id).subscribe((data: any) => {
        const retorno = data as any;

        this.firstFormGroup.get('nome').setValue(retorno[0].nome);
        this.secondFormGroup.get('telefone').setValue(retorno[0].telefone);
        this.threeFormGroup.get('whatsapp').setValue(retorno[0].whatsapp);

      });

    }



  }
  async salvarContato() {

    this.carregando = true;


    alert('Salvando contato!');

    this.contato.nome = this.firstFormGroup.get('nome').value;
    this.contato.telefone = this.secondFormGroup.get('telefone').value;
    this.contato.whatsapp = this.threeFormGroup.get('whatsapp').value;


    if (this.id != undefined) {
      await this.api.atualizarContato(this.contato,this.id).subscribe((data: any) => {
        const retorno = data as any;

        alert('Contato atualizado com sucesso!');
        console.log(retorno);
        this.carregando = false;
        location.reload();

      });
    }
    else {
      await this.api.cadastrarContato(this.contato).subscribe((data: any) => {
        const retorno = data as any;

        alert('Contato criado com sucesso!');
        console.log(retorno);
        this.carregando = false;
        location.reload();
      });
    }





  }

}
