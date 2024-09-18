
<div style="width:100%;margin:0;padding:25px;text-align:center; background-color: #f2f2f2;">

    <div style="width:40%;margin:0 auto;padding:0;text-align:center;">

        <div style="-webkit-border-top-left-radius:6px;-webkit-border-top-right-radius:6px;-moz-border-top-left-radius:6px;-moz-border-top-right-radius:6px;border-top-left-radius:6px;border-top-right-radius:6px;background-image:-webkit-linear-gradient(top, #3c3c3c 0%, #222 100%);background-image:-o-linear-gradient(top, #3c3c3c 0%, #222 100%);background-image:-webkit-gradient(linear, left top, left bottom, from(#3c3c3c), to(#222));background-image:linear-gradient(to bottom, #3c3c3c 0%, #222 100%);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff3c3c3c', endColorstr='#ff222222', GradientType=0);filter:progid:DXImageTransform.Microsoft.gradient(enabled = false);background-repeat:repeat-x;">
            <!--img src="cid:1" alt="CakePHP" style="width:200px; height:auto; margin:15px;"-->
            <!-- ?php /*echo $this->Html->image('logotipo.png', ["alt" => "CakePHP", "style" => "width: 200px; height: auto; margin: 15px;"]); */? -->
            <p style="font-size:24px; color:#ffffff; margin: 0px; padding: 10px;">
                <?php echo __('Administração - Conselho Fiscal');  ?>                
            </p>
        </div>

        <div style="background-color:#ffffff; border:solid 1px #080808;">
            <div style="text-align:justify;font-size:16px; padding-top:15px; padding-bottom:15px; padding-right:30px; padding-left:30px;">
                <p><?php echo __("Prezado <strong>". $nome . "</strong> !") ?></p>
                <p><?php echo __('Uma conta foi criada e associada a esse e-mail, para acessar a aplicação <strong>Conselhor Fiscal</strong> clique no link abaixo e informe o usuário e a senha gerados.'); ?></p>
                <p><?php echo __('Segue o link para acessar: '); ?> <a href="http://app.smport.com.br/users/login">Conselho Fiscal</a>.</p>                
            </div>
            <div style="text-align:center;">
                <p style="font-size:16px;">
                    <?php echo __('Usuário:'); ?>
                </p>
            </div>
            <div style="text-align:center;">
                <p style="font-size:24px; color:#337ab7; font-weight:bold;">
                    <?php echo $username; ?>
                </p>
            </div>
            <div style="text-align:center;">
                <p style="font-size:16px;">
                    <?php echo __('Senha:'); ?>
                </p>
            </div>
            <div style="text-align:center;">
                <p style="font-size:24px; color:#337ab7; font-weight:bold;">
                    <?php echo $password; ?>
                </p>
            </div>

            <div style="text-align:justify;font-size:16px; padding-top:50px; padding-bottom:15px; padding-right:30px; padding-left:30px;">
                <p style="font-size: 10px; color: gray; text-align:center">
                    <?php echo __('Caso não tenha criado uma conta em nosso site, ignore esta mensagem.'); ?>
                </p>
            </div>
        </div>
        <div style="-webkit-border-bottom-left-radius:6px;-webkit-border-bottom-right-radius:6px;-moz-border-bottom-left-radius:6px;-moz-border-bottom-right-radius:6px;border-bottom-left-radius:6px;border-bottom-right-radius:6px;background-image:-webkit-linear-gradient(top, #3c3c3c 0%, #222 100%);background-image:-o-linear-gradient(top, #3c3c3c 0%, #222 100%);background-image:-webkit-gradient(linear, left top, left bottom, from(#3c3c3c), to(#222));background-image:linear-gradient(to bottom, #3c3c3c 0%, #222 100%);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff3c3c3c', endColorstr='#ff222222', GradientType=0);filter:progid:DXImageTransform.Microsoft.gradient(enabled = false);background-repeat:repeat-x;">
            <div style="text-align:center;font-size:15px;font-style:italic;color:#ffffff;padding-top:10px;padding-bottom:10px;">
                <?php echo date('Y') . " &copy; " . __('smport.com.br') . " &reg; " . __('Todos os direitos reservados.'); ?>
            </div>
        </div>
    </div>
</div>