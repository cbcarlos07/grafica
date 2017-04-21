<?php
            $codigo = $_POST['id'];
            //echo "<link rel='shortcut icon' href='img/ham.png'>";
            // PRIMEIRAMENTE: INSTALEI A CLASSE NA PASTA FPDF DENTRO DE MEU SITE.
            define('FPDF_FONTPATH','fpdf/font/');

            // INSTALA AS FONTES DO FPDF
            require('fpdf/fpdf.php');

            // INSTALA A CLASSE FPDF
            class PDF extends FPDF {

            // CRIA UMA EXTENSÃO QUE SUBSTITUI AS FUNÇÕES DA CLASSE.
            // SOMENTE AS FUNÇÕES QUE ESTÃO DENTRO DESTE EXTENDS É QUE SERÃO SUBSTITUIDAS.


                function Header(){ //CABECALHO

                    $codigo = "Variavel Codigo";
                    global $codigo; // EXEMPLO DE UMA VARIAVEL QUE TERÁ O MESMO VALOR EM QUALQUER ÁREA DO PDF.
                    $l=3; // DEFINI ESTA VARIAVEL PARA ALTURA DA LINHA
                    $this->SetXY(10,10); // SetXY - DEFINE O X E O Y NA PAGINA
                    //$this->Rect(10,10,190,280); // CRIA UM RETÂNGULO QUE COMEÇA NO X = 10, Y = 10 E
                    //TEM 190 DE LARGURA E 280 DE ALTURA.
                    //NESTE CASO, É UMA BORDA DE PÁGINA.

                    // $this->Image('logo.jpg',11,11,40); // INSERE UMA LOGOMARCA NO PONTO X = 11, Y = 11, E DE TAMANHO 40.
                    $this->SetFont('Arial','B',8); // DEFINE A FONTE ARIAL, NEGRITO (B), DE TAMANHO 8


                    $this->Ln(); // QUEBRA DE LINHA

                    $l = 4;
                    $this->SetFont('Arial','B',12);
                    $this->SetXY(10,15);
                    $this->Cell(0,$l,'FICHA INDIVIDUAL','B',1,'C');

                    $this->SetFont('Arial','B',12);

                    $this->Ln();



                }

                function Footer(){ // CRIANDO UM RODAPE

                    $this->SetXY(15,260);
                    //$this->Rect(10,270,190,20);
                    $this->SetFont('Arial','',10);
                    //$this->Cell(70,8,'Assinatura ','T',0,'L');
                    $this->Cell(40,8,' ',0,0,'L');
                    //$this->Cell(70,8,'Assinatura','T',0,'L');
                    $this->Ln();
                    $this->SetFont('Arial','',7);
                    $this->Cell(190,7,utf8_decode('Página '.$this->PageNo().' de {nb}'),0,0,'L');
                    setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
                    date_default_timezone_set('America/Manaus');
                    $dia_hoje = date('d');
                    $ano_hoje = date('Y');
                    $hora_hoje = date('H:i:s');
                    $data =  'Manaus, '.ucfirst(gmstrftime('%A')).', '.$dia_hoje.' de '.utf8_decode(ucfirst(gmstrftime('%B'))).' '.$ano_hoje.' '.$hora_hoje;
                    //echo $data;

                    $this->Cell(0,7,$data,0,0,'R');


                }


            }

            //CONECTE SE AO BANCO DE DADOS SE PRECISAR
            //include("config.php"); // A MINHA CONEXÃO FICOU EM CONFIG.PHP

            include_once 'controller/FornecedorController.class.php';
            include_once 'services/FornecedorListIterator.class.php';;
            include_once 'beans/Fornecedor.class.php';
            $cc = new FornecedorController();
            $fornecedor = new Fornecedor();
            $fornecedor = $cc->getFornecedor($codigo);



            $pdf=new PDF('P','mm','A4'); //CRIA UM NOVO ARQUIVO PDF NO TAMANHO A4
            //$pdf=new PDF('L','mm','A4'); //CRIA UM NOVO ARQUIVO PDF NO TAMANHO A4
            $pdf->AddPage(); // ADICIONA UMA PAGINA
            $pdf->AliasNbPages(); // SELECIONA O NUMERO TOTAL DE PAGINAS, USADO NO RODAPE
            $pdf->SetFont('Arial','',8);

            //CAMPOS :
            $pdf->SetFont('Arial','B',10);


            $pdf->SetY(30);
            $pdf->SetX(19);
            //$pdf->Rect(10,$y,25,$l);
            $pdf->MultiCell(40,6,'CADASTRO No.',0,'L',false); // ESTA É A CELULA QUE PODE TER DADOS EM MAIS DE UMA LINHA


            $pdf->SetY(35);
            $pdf->SetX(18);
            //$pdf->Rect(10,$y,25,$l);
            $pdf->MultiCell(40,6,'RAZAO SOCIAL',0,'L',false); // ESTA É A CELULA QUE PODE TER DADOS EM MAIS DE UMA LINHA

            $pdf->SetY(40);
            $pdf->SetX(27);
            //$pdf->Rect(10,$y,25,$l);
            $pdf->MultiCell(40,6,'FANTASIA',0,'L',false); // ESTA É A CELULA QUE PODE TER DADOS EM MAIS DE UMA LINHA



            $pdf->SetY(45);
            $pdf->SetX(27);
            //$pdf->Rect(10,$y,25,$l);
            $pdf->MultiCell(40,6,'CPF/CNPJ',0,'L',false); // ESTA É A CELULA QUE PODE TER DADOS EM MAIS DE UMA LINHA


            $pdf->SetY(40);
            $pdf->SetX(125);
            //$pdf->Rect(10,$y,25,$l);
            $pdf->MultiCell(40,6,'E-MAIL',0,'L',false); // ESTA É A CELULA QUE PODE TER DADOS EM MAIS DE UMA LINHA

            $pdf->SetY(50);
            $pdf->SetX(8);
            //$pdf->Rect(10,$y,25,$l);
            $pdf->MultiCell(40,6,'DATA DO CADASTRO',0,'L',false); // ESTA É A CELULA QUE PODE TER DADOS EM MAIS DE UMA LINHA

            $pdf->SetFont('Arial','B',13);

            $pdf->SetY(54);
            $pdf->SetX(85);
            //$pdf->Rect(10,$y,25,$l);
            $pdf->MultiCell(40,6,utf8_decode('ENDEREÇO'),0,'L',false);

            $pdf->SetFont('Arial','',10);




            //DADOS
            $pdf->SetY(30);
            $pdf->SetX(40);
            //    $pdf->Rect(10,$y,20,$l);
            $pdf->MultiCell(20,6,$fornecedor->getCdFornecedor(),0,'C',false); // ESTA É A CELULA QUE PODE TER DADOS EM MAIS DE UMA LINHA


            $pdf->SetY(35);
            $pdf->SetX(48);
            //$pdf->Rect(30,$y,80,$l);
            $nome = utf8_decode($fornecedor->getDsRazaoSocial());
            $pdf->MultiCell(200,5,$nome,0,'L'); //NOME


            $pdf->SetY(40);
            $pdf->SetX(48);
            //$pdf->Rect(30,$y,80,$l);
            $nome = utf8_decode($fornecedor->getDsNmFantasia());
            $pdf->MultiCell(200,5,$nome,0,'L'); //NOME



            $pdf->SetY(40);
            $pdf->SetX(44);
            //$pdf->Rect(113,$y,16,$l);


            $pdf->SetY(45.5);
            $pdf->SetX(47);
            //$pdf->Rect(129,$y,70,$l);
            $cpfcnpj = "";
            if(strlen($fornecedor->getNrCpfCnpj()) == 11 ) {
                $cpf1 = substr($fornecedor->getNrCpfCnpj(), 0, 3);
                $cpf2 = substr($fornecedor->getNrCpfCnpj(), 3, 3);
                $cpf3 = substr($fornecedor->getNrCpfCnpj(), 6, 3);
                $cpf4 = substr($fornecedor->getNrCpfCnpj(), 9, 2);
                $cpfcnpj = "$cpf1.$cpf2.$cpf3-$cpf4";
            }else{
                //00.000.000/0000-00
                $cpf1 = substr($fornecedor->getNrCpfCnpj(), 0, 2);
                $cpf2 = substr($fornecedor->getNrCpfCnpj(), 2, 3);
                $cpf3 = substr($fornecedor->getNrCpfCnpj(), 5, 3);
                $cpf4 = substr($fornecedor->getNrCpfCnpj(), 8, 4);
                $cpf5 = substr($fornecedor->getNrCpfCnpj(), 12, 2);
                $cpfcnpj = "$cpf1.$cpf2.$cpf3/$cpf4-$cpf5";
            }
            //echo $cpf = "$cpf1.$cpf2.$cpf3-$cpf4";
            $pdf->MultiCell(35,5,$cpfcnpj,0,'C',false); //CPF


            $pdf->SetY(40);
            $pdf->SetX(138);
            //$pdf->Rect(129,$y,70,$l)
            $pdf->MultiCell(50,5,$fornecedor->getDsEmail(),0,'LS',false); //Email


            $pdf->SetY(50.5);
            $pdf->SetX(40.5);
            $dataMySQL = explode('-', $fornecedor->getDtCadastro());
            $pdf->MultiCell(35,5,"$dataMySQL[2]/$dataMySQL[1]/$dataMySQL[0]",0,'C',false); //NASCIMENTO

            $pdf->SetXY(10,50);
            $pdf->Cell(0,10,'','B',1,'C'); //LINHA VERTICAL //ENDERECO
            // *******************************************************************************************
            //LABEL ENDERECO :
            $pdf->SetFont('Arial','B',10);

            $pdf->SetY(60);
            $pdf->SetX(35);
            //$pdf->Rect(10,$y,25,$l);
            $pdf->MultiCell(40,6,'CEP',0,'L',false); // ESTA É A CELULA QUE PODE TER DADOS EM MAIS DE UMA LINHA

            $pdf->SetY(65);
            $pdf->SetX(17);
            //$pdf->Rect(/10,$y,25,$l);
            $pdf->MultiCell(40,6,'LOGRADOURO',0,'L',false);

            $pdf->SetY(65);
            $pdf->SetX(160);
            //$pdf->Rect(10,$y,25,$l);
            $pdf->MultiCell(40,6,utf8_decode('Nº'),0,'L',false); // ESTA É A CELULA QUE PODE TER DADOS EM MAIS DE UMA LINHA

            $pdf->SetY(70);
            $pdf->SetX(15);
            //$pdf->Rect(10,$y,25,$l);
            $pdf->MultiCell(40,6,'COMPLEMENTO',0,'L',false);

            $pdf->SetY(75);
            $pdf->SetX(29);
            //$pdf->Rect(10,$y,25,$l);
            $pdf->MultiCell(40,6,'BAIRRO',0,'L',false);

            $pdf->SetY(75);
            $pdf->SetX(90);
            //$pdf->Rect(10,$y,25,$l);
            $pdf->MultiCell(40,6,'CIDADE',0,'L',false);

            $pdf->SetY(75);
            $pdf->SetX(150);
            //$pdf->Rect(10,$y,25,$l);
            $pdf->MultiCell(40,6,'ESTADO',0,'L',false);


            //DADOS DO ENDEREÇO
            $pdf->SetFont('Arial','',10);
            $pdf->SetY(60.5);
            $pdf->SetX(38);
            $cep1 = substr($fornecedor->getNrCep(),0,2);
            $cep2 = substr($fornecedor->getNrCep(),2,3);
            $cep3 = substr($fornecedor->getNrCep(),5,7);

            $pdf->MultiCell(35,5,"$cep1.$cep2-$cep3",0,'C',false); //CEP

            $pdf->SetY(65.5);
            $pdf->SetX(45);
             $rua = utf8_decode(getEndereco($fornecedor->getNrCep(),'logradouro'));
            //multiceu(tamanho, altura, string, borda, alinhamento, preenchimento (true or false)  )
            $pdf->MultiCell(120,5,$rua,0,'L',false); //NASCIMENTO

            $pdf->SetY(65.5);
            $pdf->SetX(167);
            //multiceu(tamanho, altura, string, borda, alinhamento, preenchimento (true or false)  )
            $pdf->MultiCell(35,5,$fornecedor->getNrCasa(),0,'L',false); //

            $pdf->SetY(70.5);
            $pdf->SetX(45);
            //multiceu(tamanho, altura, string, borda, alinhamento, preenchimento (true or false)  )
            $pdf->MultiCell(35,5,$fornecedor->getDsComplemento(),0,'L',false); //NASCIMENTO

            $pdf->SetY(75);
            $pdf->SetX(45);
            $bairro = utf8_decode(getEndereco($fornecedor->getNrCep(),'bairro'));
            //multiceu(tamanho, altura, string, borda, alinhamento, preenchimento (true or false)  )
            $pdf->MultiCell(120,5,$bairro,0,'L',false); //NASCIMENTO

            $pdf->SetY(75.5);
            $pdf->SetX(105);
            $cidade = getEndereco($fornecedor->getNrCep(),'localidade');
            //multiceu(tamanho, altura, string, borda, alinhamento, preenchimento (true or false)  )
            $pdf->MultiCell(120,5,$cidade,0,'L',false); //NASCIMENTO000

            $pdf->SetY(75.5);
            $pdf->SetX(167);
            $estado = getEndereco($fornecedor->getNrCep(),'uf');
            //multiceu(tamanho, altura, string, borda, alinhamento, preenchimento (true or false)  )
            $pdf->MultiCell(120,5,$estado,0,'L',false); //NASCIMENTO000



            $pdf->Footer();
            $pdf->Output(); // IMPRIME O PDF NA TELA

            Header('Pragma: public'); // ESTA FUNÇÃO É USADA PELO FPDF PARA PUBLICAR NO IE

            function contaLinhas($text, $maxwidth){
                $lines=0;
                if($text==''){
                    $cont = 1;
                }else{
                    $cont = strlen($text);
                }
                if($cont < $maxwidth){
                    $lines = 1;
                }else{
                    if($cont % $maxwidth > 0){
                        $lines = ($cont / $maxwidth) + 1;
                    }else{
                        $lines = ($cont / $maxwidth);
                    }
                }
                $lines = $lines + substr_count(nl2br($text),'
            ');
                return $lines;

            }

            function formataTelefone($numero){
                if(strlen($numero) == 10){
                    $novo = substr_replace($numero, '(', 0, 0);
                    $novo = substr_replace($novo, ' ', 3, 0);
                    $novo = substr_replace($novo, '-', 8, 0);
                    $novo = substr_replace($novo, ')', 3, 0);
                }else{
                    $novo = substr_replace($numero, '(', 0, 0);
                    $novo = substr_replace($novo, ' ', 3, 0);
                    $novo = substr_replace($novo, '-', 9, 0);
                    $novo = substr_replace($novo, ')', 3, 0);
                }
                return $novo;


            }

            //funcao getEndereco via json   nova funcao
            function getEndereco($cep, $param){
//                header('Content-Type: application/json; charset=utf-8');
                $json = file_get_contents("https://viacep.com.br/ws/$cep/json/");
                $obj = json_decode($json);
                $retorno = "";
                if($param == 'logradouro'){
                    $retorno = $obj->logradouro;
                }else if($param == 'localidade'){
                    $retorno = $obj->localidade;
                }else if($param == 'uf'){
                    $retorno = $obj->uf;
                }else if($param == 'bairro'){
                    $retorno = $obj->bairro;
                }
                return $retorno;
            }

