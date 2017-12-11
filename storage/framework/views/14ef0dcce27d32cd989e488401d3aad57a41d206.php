<?php $__env->startSection('title','Ventas por Vendedor'); ?>
<?php $__env->startSection('contenido'); ?>
<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
	        <div class="x_panel">
	          <div class="x_title">
	            <h2>Estadisticas Ventas</h2>
	            <div class="clearfix"></div>
	          </div>
	          <div class="x_content">

	            <div id="grafico1" style="height:400px;"></div>

	          </div>
	        </div>
	    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<!-- ECharts -->
<script src="<?php echo e(asset('templates/gentelella')); ?>/vendors/echarts/dist/echarts.min.js"></script>
<script src="<?php echo e(asset('templates/gentelella')); ?>/vendors/echarts/map/js/world.js"></script>
<?php if($data): ?>
<script>
	var theme = {
				  color: [
					  '#26B99A', '#34495E', '#BDC3C7', '#3498DB',
					  '#9B59B6', '#8abb6f', '#759c6a', '#bfd3b7'
				  ],

				  title: {
					  itemGap: 8,
					  textStyle: {
						  fontWeight: 'normal',
						  color: '#408829'
					  }
				  },

				  dataRange: {
					  color: ['#1f610a', '#97b58d']
				  },

				  toolbox: {
					  color: ['#408829', '#408829', '#408829', '#408829']
				  },

				  tooltip: {
					  backgroundColor: 'rgba(0,0,0,0.5)',
					  axisPointer: {
						  type: 'line',
						  lineStyle: {
							  color: '#408829',
							  type: 'dashed'
						  },
						  crossStyle: {
							  color: '#408829'
						  },
						  shadowStyle: {
							  color: 'rgba(200,200,200,0.3)'
						  }
					  }
				  },

				  dataZoom: {
					  dataBackgroundColor: '#eee',
					  fillerColor: 'rgba(64,136,41,0.2)',
					  handleColor: '#408829'
				  },
				  grid: {
					  borderWidth: 0
				  },

				  categoryAxis: {
					  axisLine: {
						  lineStyle: {
							  color: '#408829'
						  }
					  },
					  splitLine: {
						  lineStyle: {
							  color: ['#eee']
						  }
					  }
				  },

				  valueAxis: {
					  axisLine: {
						  lineStyle: {
							  color: '#408829'
						  }
					  },
					  splitArea: {
						  show: true,
						  areaStyle: {
							  color: ['rgba(250,250,250,0.1)', 'rgba(200,200,200,0.1)']
						  }
					  },
					  splitLine: {
						  lineStyle: {
							  color: ['#eee']
						  }
					  }
				  },
				  timeline: {
					  lineStyle: {
						  color: '#408829'
					  },
					  controlStyle: {
						  normal: {color: '#408829'},
						  emphasis: {color: '#408829'}
					  }
				  },

				  k: {
					  itemStyle: {
						  normal: {
							  color: '#68a54a',
							  color0: '#a9cba2',
							  lineStyle: {
								  width: 1,
								  color: '#408829',
								  color0: '#86b379'
							  }
						  }
					  }
				  },
				  map: {
					  itemStyle: {
						  normal: {
							  areaStyle: {
								  color: '#ddd'
							  },
							  label: {
								  textStyle: {
									  color: '#c12e34'
								  }
							  }
						  },
						  emphasis: {
							  areaStyle: {
								  color: '#99d2dd'
							  },
							  label: {
								  textStyle: {
									  color: '#c12e34'
								  }
							  }
						  }
					  }
				  },
				  force: {
					  itemStyle: {
						  normal: {
							  linkStyle: {
								  strokeColor: '#408829'
							  }
						  }
					  }
				  },
				  chord: {
					  padding: 4,
					  itemStyle: {
						  normal: {
							  lineStyle: {
								  width: 1,
								  color: 'rgba(128, 128, 128, 0.5)'
							  },
							  chordStyle: {
								  lineStyle: {
									  width: 1,
									  color: 'rgba(128, 128, 128, 0.5)'
								  }
							  }
						  },
						  emphasis: {
							  lineStyle: {
								  width: 1,
								  color: 'rgba(128, 128, 128, 0.5)'
							  },
							  chordStyle: {
								  lineStyle: {
									  width: 1,
									  color: 'rgba(128, 128, 128, 0.5)'
								  }
							  }
						  }
					  }
				  },
				  textStyle: {
					  fontFamily: 'Arial, Verdana, sans-serif'
				  }
			  };
	var echartLine = echarts.init(document.getElementById('grafico1'), theme);

	echartLine.setOption({
				title: {
				  text: 'Ventas por Vendedor',
				  subtext: 'Ventas en pesos, concretadas en los últimos 12 Meses'
				},
				tooltip: {
				  trigger: 'axis'
				},
				legend: {
				  x: 220,
				  y: 40,
				  data: [<?php $__currentLoopData = $data['nombres']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nombre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>'<?php echo e($nombre); ?>',<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>]
				},
				toolbox: {
				  show: true,
				  feature: {
					magicType: {
					  show: true,
					  title: {
						line: 'Line',
						bar: 'Bar',
						stack: 'Stack',
						tiled: 'Tiled'
					  },
					  type: ['line', 'bar', 'stack', 'tiled']
					},
					restore: {
					  show: true,
					  title: "Restore"
					},
					saveAsImage: {
					  show: true,
					  title: "Save Image"
					}
				  }
				},
				calculable: true,
				xAxis: [{
				  type: 'category',
				  boundaryGap: false,
				  data: [<?php $__currentLoopData = $data['totales'][0]['meses']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mes): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>'<?php echo e($mes); ?>',<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>]
				}],
				yAxis: [{
				  type: 'value'
				}],
				series: [<?php $__currentLoopData = $data['totales']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendedor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>{
				  name: '<?php echo e($vendedor["nombre"][0]); ?>',
				  type: 'line',
				  smooth: true,
				  itemStyle: {
					normal: {
					  areaStyle: {
						type: 'default'
					  }
					}
				  },
				  data: [<?php $__currentLoopData = $vendedor['sumatoria']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $total): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php echo e($total); ?>,<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>]
				},<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> ]
			  });
</script>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminuser.layout.gentelella', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>