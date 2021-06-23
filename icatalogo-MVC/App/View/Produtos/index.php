
                <?php
                foreach ($dados as $produto) {
                    if ($produto->desconto > 0) {
                        $desconto = $produto->desconto / 100;
                        $novoValor = $produto->valor - $desconto * $produto->valor;
                    } else {
                        $novoValor = $produto->valor;
                    }

                    $qtdDeParcelas = $novoValor > 1000 ? 12 : 6;
                    $valorParcela = $novoValor / $qtdDeParcelas;
                    $valorParcela = number_format($valorParcela, 2, ",", ".");

                ?>
                    <article class="card-produto">
                        <figure>
                            <img src="fotos/<?= $produto->imagem ?>" />
                        </figure>
                        <section>
                            <span class="preco">R$ <?= number_format($novoValor, 2, ",", ".") ?>
                                <?php
                                if ($produto->desconto > 0) {
                                ?>
                                    <em>
                                        <?= $produto->desconto ?>% off
                                    </em>
                                <?php
                                }
                                ?>
                            </span>
                            <span class="parcelamento">ou em <em><?= $qtdDeParcelas ?>x R$<?= $valorParcela ?> sem juros</em></span>

                            <span class="descricao"><?= $produto->descricao ?></span>
                            <span class="categoria">
                                <em><?= $produto->categoria ?></em>
                            </span>

                            <?php
                                if(isset($_SESSION["usuarioId"])){
                            ?>
                                <img onclick="deletarProduto(<?= $produto->id ?>)" src="https://icons.veryicon.com/png/o/construction-tools/coca-design/delete-189.png" />
                            <?php
                                }
                            ?>
                        </section>
                        <footer>

                        </footer>
                    </article>
                <?php
                }
                ?>
                <form id="form-delecao" style="display: none;" method="POST" action="acoesProduto.php">
                    <input id="produtoId" type="hidden" name="produtoId" value="" />
                </form>